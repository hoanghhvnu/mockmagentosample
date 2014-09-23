<?php

class SM_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
//      echo __METHOD__;
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('slider_form', array('legend'=>Mage::helper('slider')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('slider')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

//      $fieldset->addField('type', 'text', array(
//          'label'     => Mage::helper('slider')->__('Type'),
//          'name'      => 'type',
//      ));

      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('slider')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('slider')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('slider')->__('Disabled'),
              ),
          ),
      ));


      if ( Mage::getSingleton('adminhtml/session')->getSliderData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSliderData());
          Mage::getSingleton('adminhtml/session')->setSliderData(null);
      } elseif ( Mage::registry('slider_data') ) {
          $form->setValues(Mage::registry('slider_data')->getData());
      }
      return parent::_prepareForm();
  }

} // end class
// end file