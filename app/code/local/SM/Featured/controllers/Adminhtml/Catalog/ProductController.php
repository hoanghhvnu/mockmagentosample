<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/17/14
 * Time: 11:34 PM
 */
/**
 * Update product(s) featured action
 *
 */
require_once ('Mage/Adminhtml/controllers/Catalog/ProductController.php');

class SM_Featured_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController{
    public function massFeaturedAction()
    {
        $productIds = (array)$this->getRequest()->getParam('product');
        $storeId    = (int)$this->getRequest()->getParam('store', 0);
        $featured  = (int)$this->getRequest()->getParam('featured');

        try {
//            $this->_validateMassStatus($productIds, $featured);
            Mage::getSingleton('catalog/product_action')
                ->updateAttributes($productIds, array('is_featured' => $featured), $storeId);
//            foreach ($productIds as $id){
//
//            }

            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($productIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while updating the product(s) status.'));
        }

        $this->_redirect('*/*/', array('store'=> $storeId));
    }
} // end class
// end file
