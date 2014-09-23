<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/19/14
 * Time: 10:14 AM
 */
//class SM_Bestseller_Adminhtml_BestsellerController extends Mage_Adminhtml_Controller_Action
require('Mage/Adminhtml/controllers/Report/SalesController.php');
class SM_Bestseller_Adminhtml_BestsellerController extends Mage_Adminhtml_Report_SalesController
{
    public function _initAction() {
        $this->loadLayout()
            ->_setActiveMenu('sm_bestseller/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    public function indexAction() {
        echo __METHOD__;
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction() {
        $id     = $this->getRequest()->getParam('id');
//        $model  = Mage::getModel('bestseller/bestseller')->load($id);

//        if ($model->getId() || $id == 0) {
//            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
//            if (!empty($data)) {
//                $model->setData($data);
//            }

//            Mage::register('bestseller_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('bestseller/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('bestseller/adminhtml_bestseller_edit'))
                ->_addLeft($this->getLayout()->createBlock('bestseller/adminhtml_bestseller_edit_tabs'));

            $this->renderLayout();
//        } else {
//            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bestseller')->__('Item does not exist'));
//            $this->_redirect('*/*/');
//        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            Zend_Debug::dump($data);
            die();


//            $model = Mage::getModel('megamenu/megamenu');
//            $model->setData($data)
//                ->setId($this->getRequest()->getParam('id'));
//
//            try {
//                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
//                    $model->setCreatedTime(now())
//                        ->setUpdateTime(now());
//                } else {
//                    $model->setUpdateTime(now());
//                }
//
//                $model->save();
//                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('megamenu')->__('Item was successfully saved'));
//                Mage::getSingleton('adminhtml/session')->setFormData(false);
//
//                if ($this->getRequest()->getParam('back')) {
//                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
//                    return;
//                }
//                $this->_redirect('*/*/');
//                return;
//            } catch (Exception $e) {
//                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
//                Mage::getSingleton('adminhtml/session')->setFormData($data);
//                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
//                return;
//            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bestseller')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }
} // end class
// end file