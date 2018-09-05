<?php
/**
 * This file contains base class for all controls
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

namespace koolreport\inputs;
use \koolreport\core\Widget;
use \koolreport\core\Utility;

class InputControl extends Widget
{
    protected $name;
    protected $dataStore;
    protected $data;
    protected $value;
    protected $attributes;

    protected function onInit()
    {
        $this->name = Utility::get($this->params,"name",null);
        if($this->name===null)
        {
            throw new \Exception("[name] property is missing");
        }
		$this->dataStore = Utility::get($this->params,"dataStore",null);
        $this->data = Utility::get($this->params,"data",null);
        $this->attributes = Utility::get($this->params,"attributes",array());

        $report = $this->getReport();
        if(!method_exists($report,"_parseParamsToInputs"))
        {
            throw new \Exception("Please add [use \koolreport\inputs\Bindable;] in your report");
        }
        $binds = $report->_parseParamsToInputs();
        $reportParams = $report->_getParams();
        foreach($binds as $paramName=>$inputName)
        {
            if($inputName==$this->name)
            {
                $this->value = Utility::get($reportParams,$paramName,null);
            }
        }
        if($this->value===null)
        {
            $this->value = Utility::get($this->params,"value");
        }
    }
}