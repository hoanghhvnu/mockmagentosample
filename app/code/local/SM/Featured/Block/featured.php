<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/18/14
 * Time: 8:40 AM
 */
class SM_Featured_Block_Featured extends Mage_Catalog_Block_Product_New{
    /**
     * Prepare and return product collection
     *
     * @return Mage_Catalog_Model_Resource_Product_Collection|Object|Varien_Data_Collection
     */
    protected function _getProductCollection()
    {
        $HandleArray = Mage::app()->getLayout()->getUpdate()->getHandles();
        $CategoryHandle = 'catalog_category_view';

        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

        $LimitFeatured = Mage::getStoreConfig('sm_featured/sm_featured_config/limitfeatured');
        if(ctype_digit($LimitFeatured) && $LimitFeatured > 0){
            $this->setProductsCount($LimitFeatured);
        }

        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToFilter('is_featured',1)
            ->setPageSize($this->getProductsCount())
            ->setCurPage(1)
        ;
        // Filter by Category if it is in category page
        if(in_array($CategoryHandle, $HandleArray)){
//            echo 'in cate';
            $CategoryId = Mage::getModel('catalog/layer')->getCurrentCategory()->getId();
            $CategoryModel = Mage::getModel('catalog/category')->load($CategoryId);
            $collection->addCategoryFilter($CategoryModel)
            ;
        }
//        $collection->getSelect()->limit($this->getProductsCount());
        return $collection;
    } // end _getProductCollection

    public function _prepareLayout()
    {
        $FeaturedStatus = Mage::getStoreConfig('sm_featured/sm_featured/enable');
        if($FeaturedStatus == 1){
            Mage::app()->getLayout()->getBlock('head')->addItem('skin_css', 'css/slider/lib/idangerous.swiper.css');
            $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/slider/lib/idangerous.swiper.js');
        }

        return parent::_prepareLayout();
    } // end _prepareLayout()
} // end class
// end file