<?php

class SM_Slider_Model_Imageslider extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('slider/imageslider');
    }
}