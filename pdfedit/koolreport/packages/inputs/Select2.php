<?php

namespace koolreport\inputs;

use \koolreport\core\Utility;

class Select2 extends InputControl
{
    protected $multiple;
    protected $placeholder;
    protected $data;
    protected $dataBind;
    protected $options;


    protected function onInit()
    {
        parent::onInit();
        $this->getAssetManager()->publish("bower_components");
        $this->getReport()->getResourceManager()->addScriptFileOnBegin(
            $this->getAssetManager()->getAssetUrl('select2/js/select2.full.min.js')
        );
        $this->getReport()->getResourceManager()->addCssFile(
            $this->getAssetManager()->getAssetUrl('select2/css/select2.min.css')
        );

        $this->multiple = Utility::get($this->params,"multiple",false);
        $this->placeholder = Utility::get($this->params,"placeholder");

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
        if($this->multiple)
        {
            $this->template('Select2m');
        }
        else
        {
            $this->template('Select2s');
        }
    }
}