<?php
/**
 * This file contains class to handle CheckBoxList
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

namespace koolreport\inputs;
use \koolreport\core\Utility;

class CheckBoxList extends InputControl
{
    protected $dataBind;
    protected $display;
    protected function onInit()
    {
        parent::onInit();
        if($this->value==null)
        {
            $this->value = array();
        } 
        $this->display = Utility::get($this->params,"display","vertical");//horizontal
        if($this->data==null)
        {
            $this->data = array();
            if($this->dataStore!=null)
            {

                $textColumn = null;
                $valueColumn = null;
                $this->dataBind = Utility::get($this->params,"dataBind",null);
                
                if($this->dataBind==null)
                {
                    $this->dataStore->popStart();
                    $row = $this->dataStore->pop();
                    if($row)
                    {
                        $keys = array_keys($row);
                        $textColumn = $keys[0];
                        $valueColumn = $keys[0];
                    }    
                }
                else
                {
                    if(gettype($this->dataBind)=="string")
                    {
                        $textColumn = $this->dataBind;
                        $valueColumn = $this->dataBind;
                    }
                    else if(gettype($this->dataBind)=="array")
                    {
                        $textColumn = Utility::get($this->dataBind,"text",null);
                        $valueColumn = Utility::get($this->dataBind,"value",$textColumn);
                    }
                }

                $this->dataStore->popStart();
                while($row = $this->dataStore->pop())
                {
                    $this->data[$row[$valueColumn]] = $row[$textColumn];
                }
            }
        }        
    }

    public function render()
    {
        $this->template('CheckBoxList');
    }   
}