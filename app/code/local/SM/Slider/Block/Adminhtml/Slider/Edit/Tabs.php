<?php

class SM_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
//      echo __METHOD__;
      parent::__construct();
      $this->setId('slider_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('slider')->__('Slider Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'title'     => Mage::helper('slider')->__('Slider Information'),
          'label'     => Mage::helper('slider')->__('General'),
          'content'   => $this->getLayout()->createBlock('slider/adminhtml_slider_edit_tab_form')->toHtml(),
      ));
//      $this->addTab('form_section2', array(
//          'title'     => Mage::helper('slider')->__('Manage Images'),
//          'label'     => Mage::helper('slider')->__('Images'),
//          'content'   => $this->getLayout()->createBlock('slider/adminhtml_imageslider_edit_tab_form')->toHtml(),
//      ));
     
      return parent::_beforeToHtml();
  }
}