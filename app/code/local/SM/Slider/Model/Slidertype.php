<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/10/14
 * Time: 4:55 PM
 */
class SM_Slider_Model_Slidertype{
    public function toOptionArray(){
        return array(
            array('value' => 'dynamic', 'label' => Mage::helper('slider')->__('Dynamic')),
            array('value' => 'activecenter', 'label' => Mage::helper('slider')->__('Active Center'))
        );
    }
}