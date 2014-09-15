<?php

class SM_Slider_Block_Adminhtml_Imageslider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'slider';
        $this->_controller = 'adminhtml_imageslider';
        
        $this->_updateButton('save', 'label', Mage::helper('slider')->__('Save Image'));
        $this->_updateButton('delete', 'label', Mage::helper('slider')->__('Delete Image'));
//        $this->_updateButton('back', 'label', Mage::helper('slider')->__('Back'), 'onclick', 'saveAndContinueEdit()');
		$this->_removeButton('back');

        $SliderId = $this->getRequest()->getParam('filtersliderid');
        $LinkRedirect = '*/*/index';
        if($SliderId != ''){
            $LinkRedirect .= '/filtersliderid/' . $SliderId;
        }
        $this->_addButton('back',array(
            'label' => 'Back',
//            'onclick' => "window.location = '{$this->getUrl('*/*/index')}'",
            'onclick' => "window.location = '{$this->getUrl($LinkRedirect)}'",
            'class' => 'back',


        ),-1);
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('slider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'slider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'slider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('imageslider_data') && Mage::registry('imageslider_data')->getId() ) {
            return Mage::helper('slider')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('imageslider_data')->getTitle()));
        } else {
            return Mage::helper('slider')->__('Add Item');
        }
    }
}