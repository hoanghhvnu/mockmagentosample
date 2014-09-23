<?php

class SM_Bestseller_Block_Adminhtml_Bestseller_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'bestseller';
        $this->_controller = 'adminhtml_bestseller';
        
        $this->_updateButton('save', 'label', Mage::helper('bestseller')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('bestseller')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('bestseller_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'bestseller_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'bestseller_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('bestseller_data') && Mage::registry('bestseller_data')->getId() ) {
            return Mage::helper('bestseller')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('bestseller_data')->getTitle()));
        } else {
            return Mage::helper('bestseller')->__('Add Item');
        }
    }
}