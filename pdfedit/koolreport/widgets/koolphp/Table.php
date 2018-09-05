<?php
/**
 * This file contains Table widget
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

// "columns"=>array(
// 	"type",
// 	"{others}"=>array(
// 		"type"=>"number",
// 		""=>"" //Expression or function
// 	)
// )


namespace koolreport\widgets\koolphp;
use \koolreport\core\Widget;
use \koolreport\core\Utility;
use \koolreport\core\DataStore;

class Table extends Widget
{
	protected $dataStore;
	protected $columns;
	protected $cssClass;
    protected $removeDuplicate;
	protected $excludedColumns;
	protected $formatFunction;
	
	protected $showFooter;
	protected $showHeader;
	protected $footer;

	protected $data;

	protected function onInit()
	{

        $data = Utility::get($this->params,"data");
        if(is_array($data) && count($data)>0)
        {
            $this->dataStore = new DataStore;
            $this->dataStore->data($data);
            $row = $data[0];
            $meta = array("columns"=>array());
            foreach($row as $cKey=>$cValue)
            {
                $meta["columns"][$cKey] = array(
                    "type"=>Utility::guessType($cValue),
                );
            }
            $this->dataStore->meta($meta);
		}
		else
		{
			$this->dataStore = Utility::get($this->params,"dataStore",null);
			if($this->dataStore==null)
			{
				throw new \Exception("dataStore is required in Table widget");
			}
		}		


		
		$this->columns = Utility::get($this->params,"columns",array());
		$this->removeDuplicate = Utility::get($this->params,"removeDuplicate",array());
		$this->cssClass = Utility::get($this->params,"cssClass",array());
		$this->excludedColumns = Utility::get($this->params,"excludedColumns",array());

		$this->showFooter = Utility::get($this->params,"showFooter");
		$this->showHeader = Utility::get($this->params,"showHeader",true);
	}

	public function render()
	{
		if($this->dataStore->countData()<1)
		{
			return;
		}

        $meta = $this->dataStore->meta();
        $showColumnKeys = array();
        
        if($this->columns==array())
        {
            $this->dataStore->popStart();
            $row = $this->dataStore->pop();
            $showColumnKeys = array_keys($row);
        }
        else
        {
            foreach($this->columns as $cKey=>$cValue)
            {

				if($cKey==="{others}")
				{
					$this->dataStore->popStart();
					$row = $this->dataStore->pop();
					$allKeys = array_keys($row);
					foreach($allKeys as $k)
					{
						if(!in_array($k,$showColumnKeys))
						{
							$meta["columns"][$k] = array_merge($meta["columns"][$k],$cValue);
							array_push($showColumnKeys,$k);
						}
					}
				}
				else
				{
					if(gettype($cValue)=="array")
					{
						if($cKey==="#")
						{
							$meta["columns"][$cKey] = array(
								"type"=>"number",
								"label"=>"#",
								"start"=>1,
							);
						}

						$meta["columns"][$cKey] =  array_merge($meta["columns"][$cKey],$cValue);                
						if(!in_array($cKey,$showColumnKeys))
						{
							array_push($showColumnKeys,$cKey);
						}
					}
					else
					{
						if($cValue==="#")
						{
							$meta["columns"][$cValue] = array(
								"type"=>"number",
								"label"=>"#",
								"start"=>1,
							);
						}
						if(!in_array($cValue,$showColumnKeys))
						{
							array_push($showColumnKeys,$cValue);
						}
					}

				}
            }            
        }

		$cleanColumnKeys = array();
		foreach($showColumnKeys as $key)
		{
			if(!in_array($key,$this->excludedColumns))
			{
				array_push($cleanColumnKeys,$key);
			}
		}
		$showColumnKeys = $cleanColumnKeys;

		
		//Remove Duplicate
        $span = null;
		$groupColumns = $this->removeDuplicate;
            
        if($groupColumns!=array())
        {
            $span = array();
            $dup = array();
            $this->dataStore->popStart();
			while($row=$this->dataStore->pop())
			{
			    $i = $this->dataStore->getPopIndex();
				$sRow = array();
				for($j=0;$j<count($groupColumns);$j++)
				{
					$gColumn = $groupColumns[$j];
					if(!isset($dup[$gColumn]))
					{
						$dup[$gColumn] = array(
							"firstIndex"=>$i,
							"value"=>$row[$gColumn]
						);
						$sRow[$gColumn] = 1;
					}
					else
					{
						if($row[$gColumn] == $dup[$gColumn]["value"])
						{
							if(isset($groupColumns[$j-1]) && isset($span[$i][$groupColumns[$j-1]]) && $span[$i][$groupColumns[$j-1]]==1)
							{
								$sRow[$gColumn] = 1;
								$dup[$gColumn]["value"] = $row[$gColumn];
								$dup[$gColumn]["firstIndex"] = $i;								
							}
							else
							{
								$span[$dup[$gColumn]["firstIndex"]][$gColumn]++;
								$sRow[$gColumn] = 0;								
							}
						}
						else
						{
							$sRow[$gColumn] = 1;
							$dup[$gColumn]["value"] = $row[$gColumn];
							$dup[$gColumn]["firstIndex"] = $i;
						}
					}
				}
				array_push($span,$sRow);
			}
		}

		if($this->showFooter)
		{
			$this->footer = array();
			foreach($showColumnKeys as $cKey)
			{
				$storage[$cKey]=null;
			}
			
			$this->dataStore->popStart();
			while($row = $this->dataStore->pop())
			{
				foreach($showColumnKeys as $cKey)
				{
					$method = Utility::get($meta["columns"][$cKey],"footer");
					if($method!==null)
					{
						switch(strtolower($method))
						{
							case "sum":
							case "avg":
								if($storage[$cKey]===null)
								{
									$storage[$cKey] = 0;
								}
								$storage[$cKey]+=$row[$cKey];
							break;
							case "min":
								if($storage[$cKey]===null)
								{
									$storage[$cKey] = INF;
								}
								if($storage[$cKey]>$row[$cKey])
								{
									$storage[$cKey]=$row[$cKey];
								}
							break;
							case "max":
								if($storage[$cKey]===null)
								{
									$storage[$cKey] = -INF;
								}
								if($storage[$cKey]<$row[$cKey])
								{
									$storage[$cKey]=$row[$cKey];
								}
							break;
						}
					}
				}
			}
			foreach($showColumnKeys as $cKey)
			{
				$method = Utility::get($meta["columns"][$cKey],"footer");
				switch(strtolower($method))
				{
					case "sum":
					case "min":
					case "max":
						$this->footer[$cKey] = $storage[$cKey];	
					break;
					case "avg":
						$this->footer[$cKey] = $storage[$cKey]/$this->dataStore->countData();
					break;
					case "count":
						$this->footer[$cKey] = $this->dataStore->countData();
					break;
				}
			}
		}
		
		
		//Prepare data
		$this->template("Table",array(
			"showColumnKeys"=>$showColumnKeys,
			"span"=>$span,
			"meta"=>$meta,
		));
	}	

}