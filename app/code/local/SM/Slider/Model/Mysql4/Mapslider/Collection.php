<?php

class SM_Slider_Model_Mysql4_Mapslider_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('slider/mapslider');
    }
}