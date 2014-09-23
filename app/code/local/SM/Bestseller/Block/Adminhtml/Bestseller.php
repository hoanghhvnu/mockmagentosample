<?php
class SM_Bestseller_Block_Adminhtml_Bestseller extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {

    $this->_controller = 'adminhtml_bestseller';
    $this->_blockGroup = 'bestseller';
    echo __METHOD__ . '<br/>';
    $this->_headerText = Mage::helper('bestseller')->__('Bestseller Manager');
    $this->_addButtonLabel = Mage::helper('bestseller')->__('Add Item');
    parent::__construct();
  }
}