<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/18/14
 * Time: 10:57 AM
 */
class SM_Bestseller_Model_BestsellerType extends Mage_Eav_Model_Entity_Attribute_Source_Abstract{
    public function getAllOptions(){
        return $this-> toOptionArray();
    }
    public function toOptionArray(){
        return array(
            array('value' => '0', 'label' => Mage::helper('slider')->__('No')),
            array('value' => '1', 'label' => Mage::helper('slider')->__('Category')),
            array('value' => '2', 'label' => Mage::helper('slider')->__('Home')),
        );
    }
}