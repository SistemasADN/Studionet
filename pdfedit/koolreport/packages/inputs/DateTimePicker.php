<?php
/**
 * This file contains widget wrapper class for date time picker
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

namespace koolreport\inputs;
use \koolreport\core\Utility;

class DateTimePicker extends InputControl
{
    protected $locale;
    protected $format;
    protected $icon;
    protected $disableDates;
    protected $minDate;
    protected $maxDate;
    protected $options;

    protected function onInit()
    {
        parent::onInit();
        $this->getAssetManager()->publish("bower_components");
        $this->getReport()->getResourceManager()->addScriptFileOnBegin(
            $this->getAssetManager()->getAssetUrl('moment/moment.min.js')
        );
        $this->getReport()->getResourceManager()->addScriptFileOnBegin(
            $this->getAssetManager()->getAssetUrl('moment/locales.min.js')
        );                
        $this->getReport()->getResourceManager()->addScriptFileOnBegin(
            $this->getAssetManager()->getAssetUrl('datetimepicker/js/datetimepicker.min.js')
        );
        $this->getReport()->getResourceManager()->addScriptFileOnBegin(
            $this->getAssetManager()->getAssetUrl('datetimepicker/js/linkedpicker.js')
        );        
        $this->getReport()->getResourceManager()->addCssFile(
            $this->getAssetManager()->getAssetUrl('datetimepicker/css/datetimepicker.min.css')
        );
        $this->format = Utility::get($this->params,"format","MMM Do, YYYY");
        $this->icon = Utility::get($this->params,"icon","glyphicon glyphicon-calendar fa fa-calendar");
        $this->disabledDates = Utility::get($this->params,"disabledDates");
        $this->minDate = Utility::get($this->params,"minDate");
        $this->maxDate = Utility::get($this->params,"maxDate");
        if($this->value===null)
        {
            $this->value=date('Y-m-d H:i:s');
        }
        else
        {
            $date = new \DateTime($this->value);
            $this->value = $date->format("Y-m-d H:i:s");
        }
        $this->options = Utility::get($this->params,"options");
    }

    public function render()
    {
        $settings = array();
        if($this->options!==null)
        {
            $settings = array_merge($settings,$this->options);
        }

        $settings["format"] = $this->format;
        $settings["defaultDate"] = $this->value;
        if($this->disabledDates)
        {
            $settings["disabledDates"] = $this->disabledDates;
        }
        if($this->minDate && strpos($this->minDate,"@")===false)
        {
            $settings["minDate"] = $this->minDate;
        }

        if($this->maxDate && strpos($this->maxDate,"@")===false)
        {
            $settings["maxDate"] = $this->maxDate;
        }
        $this->template('DateTimePicker',array(
            'settings'=>$settings,
        ));
    }
}