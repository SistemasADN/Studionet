<?php
/* Usage
 * ->pipe(new Pivot(array(
 * 		"dimensions"=>array(
 *		  "row"=>"customerName, productLine",
 *	    "column"=>"productName"
 *		),
 *		"aggregates"=>array(
 *			"sum"=>"dollar_sales"
 *		)
 * )))
 * */
namespace koolreport\pivot\processes;
use \koolreport\core\Utility;

class Pivot extends \koolreport\core\Process
{
	protected $dimensions = array();
  protected $dataFields = array();
  protected $data = array();
  protected $count = array();
  
  protected $nameToIndexD = array();
  protected $indexToNameD = array();
  protected $forwardMeta;
	
	protected $relations = array();
  protected $relationNodes = array();
  protected $relationNodeToIndex = array();
  protected $relationsData = array();
  
  public function onInit() {
    $this->dimensions = Utility::get($this->params, "dimensions", array());
    $dimensions = array();
    foreach ($this->dimensions as $d => $dimension) {
      $dimensions[$d] = array();
      $dimension = explode(',', $dimension);
      foreach ($dimension as $field) {
        $field = trim($field);
        if (! empty($field))
          array_push($dimensions[$d], $field);
      }
    }
    $this->dimensions = $dimensions;
    
		$this->dataFields = array();
    foreach ($this->params['aggregates'] as $aggregate => $fields) {
      $fields = explode(',', $fields);
      foreach ($fields as $field) {
        $field = trim($field);
        if (! isset($this->dataFields[$field]))
          $this->dataFields[$field] = array();
        array_push($this->dataFields[$field], trim($aggregate));    
      }
    }  
    
    foreach ($this->dimensions as $d => $dimension) {
      $this->nameToIndexD[$d] = array();
      $this->indexToNameD[$d] = array();
    }
    
    $this->relations = Utility::get($this->params, "relations", array());
    foreach ($this->relations as $relation) {
      $relationName = implode(' - ', $relation);
      $this->relationNodes[$relationName] = array();
      $this->relationNodeToIndex[$relationName] = array();
      $this->relationData[$relationName] = array();
      foreach ($relation as $field) {
        $this->relationNodes[$relationName][$field] = array();
        $this->relationNodeToIndex[$relationName][$field] = array();
        // $this->relationData[$relationName][$field] = array();
      }
    }
  }
  
  public function onInput($row)
	{
    $dataFields = $this->dataFields;
    $data = $this->data;
    $count = $this->count;
    $nodesD = array();
    $rootNode = 'Root';
    foreach ($this->dimensions as $d => $dimension) {
      $nameToIndex = $this->nameToIndexD[$d];
      $indexToName = $this->indexToNameD[$d];
      $nodesD[$d] = array();
      
      $node = array();
      foreach ($dimension as $i => $labelField) 
        $node[$labelField] = '{{all}}';
      $nodeName = implode(' - ', $node);
      if (! isset($nameToIndex[$nodeName])) {
        $index = count($indexToName);
        $nameToIndex[$nodeName] = $index;
        $indexToName[$index] = $node;
      }
      array_push($nodesD[$d], 0);
      foreach ($dimension as $i => $labelField) {
        $node[$labelField] = isset($row[$labelField]) ? 
            $row[$labelField] : '{{other}}';
        $nodeName = implode(' - ', $node);
        if (! isset($nameToIndex[$nodeName])) {
          $index = count($indexToName);
          $nameToIndex[$nodeName] = $index;
          $indexToName[$index] = $node;
        }
        array_push($nodesD[$d], $nameToIndex[$nodeName]);
      }
      $this->nameToIndexD[$d] = $nameToIndex;
      $this->indexToNameD[$d] = $indexToName;
    }
    
    $dataNodes = $this->buildDataNodes($nodesD);
    foreach ($dataNodes as $dataNode) {
      if (! isset($data[$dataNode])) {
        $data[$dataNode] = array();
        foreach ($dataFields as $dataField => $aggregates)
          foreach ($aggregates as $aggregate)
            $data[$dataNode][$dataField . ' - ' . $aggregate] = $this->initValue($aggregate);
        $count[$dataNode] = array();
        $count[$dataNode] = $this->initValue('count');
      }
      foreach ($dataFields as $dataField => $aggregates) 
        foreach ($aggregates as $aggregate)
          $data[$dataNode][$dataField . ' - ' . $aggregate] = $this->aggValue($aggregate, 
              $data[$dataNode][$dataField . ' - ' . $aggregate], $row[$dataField]);
      $count[$dataNode] = $this->aggValue('count', 
            $count[$dataNode], $row[$dataField]);
    }
    $this->data = $data;
    $this->count = $count;
    
    foreach ($this->relations as $relation) {
      $relationName = implode(' - ', $relation);
      $data = $this->relationData[$relationName];
      $nodes = array();
      foreach ($relation as $field) {
        $nodeName = isset($row[$field]) ? $row[$field] : '{{other}}';
        if (! isset($this->relationNodeToIndex[$relationName][$field][$nodeName])) {
          array_push($this->relationNodes[$relationName][$field], $nodeName);
          $this->relationNodeToIndex[$relationName][$field][$nodeName] = 
            count($this->relationNodes[$relationName][$field]);
        }
        $node = $this->relationNodeToIndex[$relationName][$field][$nodeName];
        $nodes[$field] = $node;
      }
      $dataNode = implode(' : ', $nodes);
      if (! isset($data[$dataNode])) {
        $data[$dataNode] = array();
        foreach ($dataFields as $dataField => $aggregates)
          foreach ($aggregates as $aggregate)
            $data[$dataNode][$dataField . ' - ' . $aggregate] = $this->initValue($aggregate);
      }
      foreach ($dataFields as $dataField => $aggregates)
        foreach ($aggregates as $aggregate)
          $data[$dataNode][$dataField . ' - ' . $aggregate] = $this->aggValue($aggregate, 
              $data[$dataNode][$dataField . ' - ' . $aggregate], $row[$dataField]);
      $this->relationData[$relationName] = $data;
    }
    
	}
  
  private function buildDataNodes($nodesD) 
  {
    $dataNodes = array();
    $nodes1 = reset($nodesD);
    if (count($nodesD) <= 1) {
      foreach ($nodes1 as $node)
        // if ($node !== 0) //i.e node !== {{all}}
          array_push($dataNodes, $node);
      return $dataNodes;
    }
    $nodesD2 = array_slice($nodesD, 1);
    $dataNodes2 = $this->buildDataNodes($nodesD2);
    foreach ($nodes1 as $node1)
      foreach ($dataNodes2 as $dataNode2) 
      // if ($node1 !== 0) //i.e node1 !== {{all}}
      {
        $node = $node1 . ' : ' . $dataNode2;
        array_push($dataNodes, $node);
      }
      
    return $dataNodes;
  }
  
  private function initValue($aggregate) {
    switch ($aggregate) {
      case 'min':
        return PHP_INT_MAX; 
      case 'max':
        return PHP_INT_MIN;
      case 'sum':
      case 'count':
      case 'avg':
      default:
        return 0;
    }
  }
  
  private function aggValue($aggregate, $value1, $value2) {
    switch ($aggregate) {
      case 'min':
        return min($value1, $value2);
      case 'max':
        return max($value1, $value2);
      case 'count':
        return $value1 + 1;
      case 'avg':
      case 'sum':
      default:
        return (float) $value1 + (float) $value2;
    }
  }
  
  public function finalize() {
    foreach ($this->dataFields as $dataField => $aggregate)
      if ($aggregate === 'avg') {
        foreach ($this->data as $key => $datum) 
          $this->data[$key][$dataField] = 
            $this->data[$key][$dataField] / $this->count[$key];
      }
    
    $metaData = array();
    foreach ($this->dimensions as $d => $dimension) {
      $metaDimension = array();
      $indexToName = $this->indexToNameD[$d];
      foreach ($indexToName as $i => $name) {
        array_push($metaDimension, $name);
      }
      $metaData[$d] = array('type' => 'dimension', 'index' => $metaDimension);
    }
    $this->forwardMeta['columns'] = array_merge($this->forwardMeta['columns'], $metaData);

    $data = array();
    foreach ($this->data as $keys => $datum) {
      $row = array();
      $keys = explode(' : ', $keys);
      $i = 0;
      $dimensionKeys = array_keys($this->dimensions);
      foreach ($keys as $d => $key) {
        $dimensionKey = $dimensionKeys[$i];
        $row[$dimensionKeys[$i]] = $key;
        $i++;
      }
      $row = array_merge($row, $datum);
      array_push($data, $row);
    }
    $this->data = $data;
  }
  
  public function receiveMeta($metaData, $source) 
  {
    $this->metaData = array_merge($this->metaData, $metaData);
    $dataFields = $this->dataFields;
    
    $this->forwardMeta = $this->metaData;
    
    $columns = $this->forwardMeta['columns'];
    foreach ($dataFields as $dataField => $aggregates) 
      foreach ($columns as $col => $des)
        if ($col === $dataField) {
          foreach ($aggregates as $aggregate) {
            $aggField = $dataField . ' - ' . $aggregate;
            if ($aggregate !== 'count')
              $columns[$aggField] = $des;
            else
              $columns[$aggField] = array('type' => 'number');
          }
        }
    $this->forwardMeta['columns'] = $columns;    
  }
  
  public function onInputEnd()
	{
    $this->finalize();
        
    $this->sendMeta($this->forwardMeta);
    
    foreach($this->data as $row)
    {
      $this->next($row);
    }		
	}
}