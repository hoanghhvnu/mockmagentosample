<?php
class SM_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
//      echo __METHOD__;
    $this->_controller = 'adminhtml_slider';
    $this->_blockGroup = 'slider';
//      echo __METHOD__;
      $this->_headerText = Mage::helper('slider')->__('Slider Manager');

    $this->_addButtonLabel = Mage::helper('slider')->__('Add Item');
    parent::__construct();
  }
}