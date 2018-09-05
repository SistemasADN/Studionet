<?php
/**
 * This file contains wrapper class for MultiSelect
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

namespace koolreport\inputs;

class MultiSelect extends Select
{
    protected function onInit()
    {
        parent::onInit();
        if($this->value===null)
        {
            $this->value = array();
        }
        else if(gettype($this->value)!="array")
        {
            $this->value = array($this->value);
        }
    }
    public function render()
    {
        $this->template('MultiSelect');
    }
}