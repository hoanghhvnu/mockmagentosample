<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/10/14
 * Time: 4:55 PM
 */
class SM_Slider_Model_Slidermode{
    public function toOptionArray(){
        return array(
            array('value' => 'horizontal', 'label' => Mage::helper('slider')->__('Horizontal')),
            array('value' => 'vertical', 'label' => Mage::helper('slider')->__('Vertical'))
        );
    }
}