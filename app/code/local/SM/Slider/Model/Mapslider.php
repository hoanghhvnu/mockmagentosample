<?php

class SM_Slider_Model_Mapslider extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('slider/mapslider');
    }
}