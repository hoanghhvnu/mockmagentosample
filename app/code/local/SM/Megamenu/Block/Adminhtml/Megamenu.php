<?php
class SM_Megamenu_Block_Adminhtml_Megamenu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {

    $this->_controller = 'adminhtml_megamenu';
    $this->_blockGroup = 'megamenu';
//      echo __METHOD__;
      $this->_headerText = Mage::helper('megamenu')->__('Mega menu Manager');

    $this->_addButtonLabel = Mage::helper('megamenu')->__('Add Item');
    parent::__construct();
  }
}