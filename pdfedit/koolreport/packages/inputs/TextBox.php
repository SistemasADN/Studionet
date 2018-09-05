<?php
/**
 * This file contains wrapper class for Textbox
 *
 * @author KoolPHP Inc (support@koolphp.net)
 * @link https://www.koolphp.net
 * @copyright 2008-2017 KoolPHP Inc
 * @license https://www.koolreport.com/license#mit-license
 */

namespace koolreport\inputs;
use \koolreport\core\Utility;

class TextBox extends InputControl
{
    protected function onInit()
    {
        parent::onInit();
    }

    public function render()
    {
        $this->template('TextBox');
    }
}