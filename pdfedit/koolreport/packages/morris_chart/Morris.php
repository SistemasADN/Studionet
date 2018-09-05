<?php
/**
 * This file contains Morris chart widget
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license
 */
namespace koolreport\morris_chart;
use \koolreport\core\Utility;

class Morris extends \koolreport\core\Widget
{
    protected $chartId;
    protected $type;
    protected $options;
    protected $dataStore;
    protected $width;
    protected $height;
    protected $title;
    protected $colorScheme;

    protected $data;

    protected function onInit()
    {
        $this->chartId = "morris_".Utility::getUniqueId();

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
            if(!$this->dataStore)
            {
                throw new \Exception("The dataStore property is required");
            }    
        }

        $this->columns = Utility::get($this->params,"columns",null);
        $this->options = Utility::get($this->params,"options",array());
        $this->width = Utility::get($this->params,"width","600px");
        $this->height = Utility::get($this->params,"height","400px");
        $this->title = Utility::get($this->params,"title");
        $this->type = Utility::getClassName($this);

        $colorScheme = Utility::get($this->params,"colorScheme");
        if($colorScheme!==null)
        {
            switch(gettype($colorScheme))
            {
                case "string":
                    $colorScheme = intval($colorScheme);
                case "integer":
                    //Get the color scheme from theme
                    $this->colorScheme = $this->getReport()->getColorScheme($colorScheme);
                break;
                case "array":
                    $this->colorScheme = $colorScheme;
                break;
            }
        }
        else
        {
            $this->colorScheme = $this->getReport()->getColorScheme();
        }

        if($this->type=="Morris")
        {
            Utility::get($this->params,"type");
        }
    }

    protected function getColumnList()
    {
        $meta = $this->dataStore->meta();
        $columns=array();
        if($this->columns!=null)
        {
            foreach($this->columns as $cKey=>$cValue)
            {
                if(gettype($cValue)=="array")
                {
                    $columns[$cKey] = array_merge($meta["columns"][$cKey],$cValue);
                }
                else
                {
                    $columns[$cValue] = $meta["columns"][$cValue];
                }
            }
        }
        else
        {
            $this->dataStore->popStart();
            $row = $this->dataStore->pop();
            $keys = array_keys($row);
            foreach($keys as $ckey)
            {
                $columns[$ckey] = $meta["columns"][$ckey];
            }
        }
        return $columns;
    }

    protected function encode($json)
    {
        $str = json_encode($json);

        foreach($json as $key=>$value)
        {
            if(gettype($value)==="string" && strpos($value,"function")===0)
            {
                $str = str_replace("\"$key\":\"$value\"","\"$key\":$value",$str);
            }
        }
        return $str;
    }

    protected function roundNumber($value,$decimals)
    {
       return round($value*pow(10,$decimals))/pow(10,$decimals);
    }


    protected function prepareOptions()
    {
        return $this->options;
    }

    public function render()
    {
        //Get raphael and jquery register
        $jqueryFolder = realpath(dirname(__FILE__)."/../../clients/jquery");
        $raphaelFolder = realpath(dirname(__FILE__)."/../../clients/raphael");
        $raphaelPublicUrl = $this->getReport()->publishAssetFolder($raphaelFolder);
        $jqueryPublicUrl = $this->getReport()->publishAssetFolder($jqueryFolder);
    
        $this->getReport()->getResourceManager()->addScriptFileOnBegin($raphaelPublicUrl."/raphael.min.js");
        $this->getReport()->getResourceManager()->addScriptFileOnBegin($jqueryPublicUrl."/jquery.min.js");

        $this->getAssetManager()->publish("assets");
        $this->getReport()->getResourceManager()->addScriptFileOnBegin($this->getAssetManager()->getAssetUrl("morris.min.js"));
        $this->getReport()->getResourceManager()->addCssFile($this->getAssetManager()->getAssetUrl("morris.css"));


        
        $this->template('Morris',array(
            "options"=>$this->prepareOptions(),
        ));
    }
}