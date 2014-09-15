<?php
class SM_Slider_Block_Adminhtml_Imageslider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {

        $this->_controller = 'adminhtml_imageslider';
        $this->_blockGroup = 'slider';
//      echo __METHOD__;
        $this->_headerText = Mage::helper('slider')->__('Image Manager');

        $this->_addButtonLabel = Mage::helper('slider')->__('Add Item');
        parent::__construct();
    }
}