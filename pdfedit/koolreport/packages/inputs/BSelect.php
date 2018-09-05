<?php
/**
 * This file contains class to handle Bootrap MultiSelect
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

namespace koolreport\inputs;
use \koolreport\core\Utility;

class BSelect extends InputControl
{
    protected $placeholder;
    protected $data;
    protected $dataBind;
    protected $options;
    protected $multiple=false;

    protected function onInit()
    {
        parent::onInit();
        $this->getAssetManager()->publish("bower_components");
        $this->getReport()->getResourceManager()->addScriptFileOnBegin(
            $this->getAssetManager()->getAssetUrl('bootstrap-multiselect/bootstrap-multiselect.js')
        );
        $this->getReport()->getResourceManager()->addCssFile(
            $this->getAssetManager()->getAssetUrl('bootstrap-multiselect/bootstrap-multiselect.css')
        );

        $this->multiple = Utility::get($this->params,"multiple",false);

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
        $this->defaultOption = Utility::get($this->params,"defaultOption",null);
        if($this->defaultOption)
        {
            $this->data = array_merge($this->defaultOption,$this->data);
        }        
        if($this->multiple===true && $this->value===null)
        {
            $this->value = array();
        }
        $this->options = Utility::get($this->params,"options",array());

        $this->placeholder = Utility::get($this->params,"placeholder");
        if($this->placeholder!=null)
        {
            $this->attributes["placeholder"] = $this->placeholder;
        }
    }
    public function render()
    {
        $this->template("BSelect");
    }
}