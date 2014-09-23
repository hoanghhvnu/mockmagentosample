<?php

class SM_Bestseller_Block_Adminhtml_Bestseller_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('bestseller_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('bestseller')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('bestseller')->__('Item Information'),
          'title'     => Mage::helper('bestseller')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('bestseller/adminhtml_bestseller_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}