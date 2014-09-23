<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/23/14
 * Time: 9:39 AM
 */
class SM_Bestseller_Model_TimePeriod{
    public function toOptionArray(){
        return array(
            array('value' => 'subDay', 'label' => Mage::helper('bestseller')->__('Day')),
            array('value' => 'subWeek', 'label' => Mage::helper('bestseller')->__('Week')),
            array('value' => 'subMonth', 'label' => Mage::helper('bestseller')->__('Month')),
            array('value' => 'subYear', 'label' => Mage::helper('bestseller')->__('Year')),
            array('value' => 'specify', 'label' => Mage::helper('bestseller')->__('Choose range')),
        );
    }
}