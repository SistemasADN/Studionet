<?php
namespace koolreport\pivot;
use \koolreport\core\Utility;

class PivotReader
{
  protected $dataStore;
  protected $params;
  
	protected $measures;
	protected $rowDimension;
	protected $columnDimension;
	protected $rowSort;
	protected $columnSort;
	protected $headerMap;
	protected $dataMap;
	protected $hideTotalRow;
	protected $hideTotalColumn;
  
  protected $FieldsNodesIndexes;
  
  public function __construct($dataStore, $params) {
    $this->dataStore = $dataStore;
    $this->params = $params;
    
    $this->rowDimension = Utility::get($this->params, 'rowDimension', 'row');
		$this->columnDimension = Utility::get($this->params, 'columnDimension', 'column');
		$this->rowSort = Utility::get($this->params, 'rowSort', array());
		$this->columnSort = Utility::get($this->params, 'columnSort', array());
		$this->headerMap = Utility::get($this->params, 'headerMap', 
      function($v, $f){return $v;});
		$this->dataMap = Utility::get($this->params, 'dataMap', null);
    $this->totalName = Utility::get($this->params, 'totalName', 'Total');
    $this->hideTotalRow = Utility::get($this->params, 'hideTotalRow', false);
    $this->hideTotalColumn = Utility::get($this->params, 'hideTotalColumn', false);
		
		//Get the measure field and settings in format
		$measures = array();
		$mSettings = Utility::get($this->params,'measures',array());
    $meta = $dataStore->meta()['columns'];
		foreach($mSettings as $cKey=>$cValue) {
			if(gettype($cValue)=='array')
				$measures[$cKey] = $cValue;
			else
				$measures[$cValue] = $meta[$cValue];
		}
    if (empty($measures)) {
      $dataStore->popStart();
      $row = $dataStore->pop();
      $columns = array_keys($row);
      foreach ($columns as $c)
        if ($meta[$c]['type'] !== 'dimension')
          $measures[$c] = $meta[$c];
    }
    $this->measures = $measures;
    
    $this->read();
  }
  
  public function sort(& $index, $nodes, $fields, 
      $nameToIndex, $dimIndexToData, $sort, $dataFields) 
  {
    usort($index, function($a, $b) use ($nodes, $fields, 
        $nameToIndex, $dimIndexToData, $dataFields, $sort) {
      $cmp = 0;
      $parentNode = array();
      foreach ($fields as $field)
        $parentNode[$field] = '{{all}}';
      foreach ($fields as $field) {
        $value1 = $nodes[$a][$field];
        $value2 = $nodes[$b][$field];
        $parentNode2 = $parentNode1 = $parentNode;
        $parentNode1[$field] = $value1;
        $parentNode2[$field] = $value2;
        if ($value1 === $value2) {
          $parentNode[$field] = $value1;
          continue;
        }
        else if ($value1 === '{{all}}')
          return 1;
        else if ($value2 === '{{all}}')
          return -1;
        else {
          $cmp = strcmp($value1, $value2);
          $sortField = isset($sort[$field]) ? $sort[$field] : null;
          if (is_string($sortField))
            $cmp = $sortField === 'asc' ? $cmp : - $cmp;
          else if (is_callable($sortField))
            $cmp = $sortField($value2, $value1);
        }
        if ($cmp !== 0)
          break;
      }
      $dataCmp = $cmp;
      foreach ($dataFields as $field)
        if (isset($sort[$field])) {
          $dataSortField = $field;
          $dataSortDirection = $sort[$field];
          break;
        }
      if (isset($dataSortField)) {
        $index1 = $nameToIndex[implode(' - ', $parentNode1)];
        $index2 = $nameToIndex[implode(' - ', $parentNode2)];
        $sortValue1 = isset($dimIndexToData[$index1]) ? 
            $dimIndexToData[$index1][$dataSortField] : 0;
        $sortValue2 = isset($dimIndexToData[$index2]) ? 
            $dimIndexToData[$index2][$dataSortField] : 0;
        $diff = $sortValue1 - $sortValue2;
        if (is_string($dataSortDirection))
          $dataCmp = $dataSortDirection === 'asc' ? $diff : - $diff;
        else if (is_callable($dataSortDirection))
          $dataCmp = $dataSortDirection($sortValue1, $sortValue2);
      }
      return $dataCmp;
    });
  }
  
  private function read() {
    if(!$this->dataStore) return array();
    
    $dataStore = $this->dataStore;
    $meta = $dataStore->meta()['columns'];
    $data = $dataStore->data();
    
    $rowDimension = isset($meta[$this->rowDimension]) ?
        $this->rowDimension : null;
    $columnDimension = isset($meta[$this->columnDimension]) ? 
        $this->columnDimension : null;
    
    $rowNodes = isset($rowDimension) ?
        $meta[$rowDimension]['index'] : null;
    $colNodes = isset($columnDimension) ? 
        $meta[$columnDimension]['index'] : null;
    if (empty($rowNodes) || empty($rowNodes[0]))
      $rowNodes = array(array('root' => '{{all}}'));
    if (empty($colNodes) || empty($colNodes[0]))
      $colNodes = array(array('root' => '{{all}}'));
    
    $rowFields = array_keys($rowNodes[0]);
    $colFields = array_keys($colNodes[0]);
    // $dataFields = $this->measures;
    $dataFields = array_keys($this->measures);
      
    $nameToIndexRow = array();
    foreach($rowNodes as $i => $node) 
      $nameToIndexRow[implode(' - ', $node)] = $i;
    $nameToIndexCol = array();
    foreach($colNodes as $i => $node) 
      $nameToIndexCol[implode(' - ', $node)] = $i;
    
    $rowIndexToData = array();
    $colIndexToData = array();
    $indexToData = array();
    foreach ($data as $dataRow) {
      $rowIndex = (int) Utility::get($dataRow, $rowDimension, 0);
      $colIndex = (int) Utility::get($dataRow, $columnDimension, 0);
      if (isset($rowDimension) && $colIndex === 0)
        $rowIndexToData[$rowIndex] = $dataRow;
      if (isset($columnDimension) && $rowIndex === 0)
        $colIndexToData[$colIndex] = $dataRow;
      $indexToData[$rowIndex][$colIndex] = $dataRow;
    }
    
    $rowIndexes = range(0, count($rowNodes) - 1);
    $this->sort($rowIndexes, $rowNodes, $rowFields,
        $nameToIndexRow, $rowIndexToData, $this->rowSort, $dataFields);
    $colIndexes = range(0, count($colNodes) - 1);
    $this->sort($colIndexes, $colNodes, $colFields, 
        $nameToIndexCol, $colIndexToData, $this->columnSort, $dataFields);
        
    $rowNodesMark = array_fill(0, count($rowNodes), array());
    $rowspan = array_fill_keys($rowFields, 1);
    $nullNode = array_fill_keys($rowFields, null);
    $lastSameNodeField = array_fill_keys($rowFields, $rowIndexes[0]);
    array_push($rowIndexes, count($rowIndexes));
    foreach ($rowIndexes as $i => $index) {
      $node = isset($rowNodes[$index]) ? $rowNodes[$index] : $nullNode;
      $prevNode = isset($rowIndexes[$i - 1]) ? 
          $rowNodes[$rowIndexes[$i - 1]] : $nullNode;
      $firstAllCell = -1;
      foreach ($rowFields as $j => $f) {
        if ($node[$f] !== $prevNode[$f]) {
          if ($rowNodes[$lastSameNodeField[$f]][$f] !== '{{all}}') {
            $rowNodesMark[$lastSameNodeField[$f]][$f . '_rowspan'] = $rowspan[$f];
            $rowNodesMark[$lastSameNodeField[$f]][$f . '_colspan'] = 1;
          }
          $lastSameNodeField[$f] = $index;
          $rowspan[$f] = 1;
        }
        else {
          $rowspan[$f] += 1;
        }
        if ($firstAllCell === -1 && $node[$f] === '{{all}}') {
          $firstAllCell = $j;
          $rowNodesMark[$index][$f . '_colspan'] = count($rowFields) - $j;
          $rowNodesMark[$index][$f . '_rowspan'] = 1;
        }
      }
    }
    array_pop($rowIndexes);
    if ($this->hideTotalRow)
      array_pop($rowIndexes);
    
    $colNodesMark = array_fill(0, count($colNodes), array());
    $colspan = array_fill_keys($colFields, 1);
    $nullNode = array_fill_keys($colFields, null);
    $lastSameNodeField = array_fill_keys($colFields, $colIndexes[0]);
    array_push($colIndexes, count($colIndexes));
    foreach ($colIndexes as $i => $index) {
      $node = isset($colNodes[$index]) ? $colNodes[$index] : $nullNode;
      $prevNode = isset($colIndexes[$i - 1]) ? 
          $colNodes[$colIndexes[$i - 1]] : $nullNode;
      $firstAllCell = -1;
      foreach ($colFields as $j => $f) {
        if ($node[$f] !== $prevNode[$f]) {
          if ($colNodes[$lastSameNodeField[$f]][$f] !== '{{all}}') {
            $colNodesMark[$lastSameNodeField[$f]][$f . '_colspan'] = 
              $colspan[$f] * count($dataFields);
            $colNodesMark[$lastSameNodeField[$f]][$f . '_rowspan'] = 1;
          }
          $lastSameNodeField[$f] = $index;
          $colspan[$f] = 1;
        }
        else {
          $colspan[$f] += 1;
        }
        if ($firstAllCell === -1 && $node[$f] === '{{all}}') {
          $firstAllCell = $j;
          $colNodesMark[$index][$f . '_rowspan'] = count($colFields) - $j;
          $colNodesMark[$index][$f . '_colspan'] = count($dataFields);
        }
      }
    }
    array_pop($colIndexes);
    if ($this->hideTotalColumn)
      array_pop($colIndexes);
    
    // Utility::prettyPrint($rowNodes);
    $totalName = $this->totalName;
    $headerMap = $this->headerMap;
    $headerMap = function($v, $f) use ($headerMap, $totalName) {
      if ($v === '{{all}}') return $totalName;
      if (is_array($headerMap))
        return isset($headerMap[$v]) ? $headerMap[$v] : $v;
      return $headerMap($v, $f);
    };
    foreach ($rowNodes as $i => $node) 
      $rowNodes[$i] = array_combine($rowFields,
        array_map($headerMap, $node, $rowFields));
    foreach ($colNodes as $i => $node)
      $colNodes[$i] = array_combine($colFields,
        array_map($headerMap, $node, $colFields));
    $dataNodes = array_combine($dataFields,
        array_map($headerMap, $dataFields, $dataFields));
      
    $dataMap = $this->dataMap;
    if (is_array($dataMap)) 
      $dataMap = function($v) use ($dataMap) {
        return isset($dataMap[$v]) ? $dataMap[$v] : $v;
      };
    foreach ($indexToData as $r => $cs)
      foreach ($cs as $c => $d)
        if (is_callable($dataMap))
          $indexToData[$r][$c] = array_combine(array_keys($d), 
            array_map($dataMap, $d, array_keys($d)));
        else 
          foreach ($d as $df => $v) {
            // $indexToData[$r][$c][$df] = Utility::format($v, $meta[$df]);
            $indexToData[$r][$c][$df] = Utility::format($v, 
              isset($this->measures[$df]) ? $this->measures[$df] : $meta[$df]);
          }
        
    // Utility::prettyPrint($rowNodes);
    // Utility::prettyPrint($data);
    $this->FieldsNodesIndexes = array(
      'rowNodes' => $rowNodes,
      'rowNodesMark' => $rowNodesMark,
      'rowIndexes' => $rowIndexes,
      'rowFields' => $rowFields,
      'colNodes' => $colNodes,
      'colNodesMark' => $colNodesMark,
      'colIndexes' => $colIndexes,
      'colFields' => $colFields,
      'dataNodes' => $dataNodes,
      'dataFields' => $dataFields,
      'indexToData' => $indexToData,
    );
  }
  
  public function getFieldsNodesIndexes() {
    return $this->FieldsNodesIndexes;
  }
}