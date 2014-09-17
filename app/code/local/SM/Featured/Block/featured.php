<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/16/14
 * Time: 9:44 AM
 */
class SM_Featured_Block_Featured extends Mage_Catalog_Block_Product_Abstract{
    /**
     * Default value for products count that will be shown
     */
    const DEFAULT_PRODUCTS_COUNT = 10;

    /**
     * Products count
     *
     * @var null
     */
    protected $_productsCount;

    /**
     * Initialize block's cache
     */
    protected function _construct()
    {
        parent::_construct();

        $this->addColumnCountLayoutDepend('empty', 6)
            ->addColumnCountLayoutDepend('one_column', 5)
            ->addColumnCountLayoutDepend('two_columns_left', 4)
            ->addColumnCountLayoutDepend('two_columns_right', 4)
            ->addColumnCountLayoutDepend('three_columns', 3);

        $this->addData(array('cache_lifetime' => 86400));
        $this->addCacheTag(Mage_Catalog_Model_Product::CACHE_TAG);
    }

    /**
     * Get Key pieces for caching block content
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        return array(
            'CATALOG_PRODUCT_NEW',
            Mage::app()->getStore()->getId(),
            Mage::getDesign()->getPackageName(),
            Mage::getDesign()->getTheme('template'),
            Mage::getSingleton('customer/session')->getCustomerGroupId(),
            'template' => $this->getTemplate(),
            $this->getProductsCount()
        );
    }

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

        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToFilter('is_featured',1)
            ->setPageSize($this->getProductsCount())
            ->setCurPage(1)

        ;

        // Filter by Category if it is in category page
        if(in_array($CategoryHandle, $HandleArray)){
            $CategoryId = Mage::getModel('catalog/layer')->getCurrentCategory()->getId();
            $CategoryModel = Mage::getModel('catalog/category')->load($CategoryId);
            $collection->addCategoryFilter($CategoryModel)
            ;
        }
//        $collection->getSelect()->limit($this->getProductsCount());
        return $collection;
    } // end _getProductCollection

    /**
     * Prepare collection with new products
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        $this->setProductCollection($this->_getProductCollection());
        return parent::_beforeToHtml();
    }

    /**
     * Set how much product should be displayed at once.
     *
     * @param $count
     * @return Mage_Catalog_Block_Product_New
     */
    public function setProductsCount($count)
    {
        $this->_productsCount = $count;
        return $this;
    }

    /**
     * Get how much products should be displayed at once.
     *
     * @return int
     */
    public function getProductsCount()
    {
        $LimitFeatured = Mage::getStoreConfig('sm_featured/sm_featured_config/limitfeatured');
        if(ctype_digit($LimitFeatured) && $LimitFeatured > 0){
            $this->_productsCount = $LimitFeatured;
        }
        if (null === $this->_productsCount) {
            $this->_productsCount = self::DEFAULT_PRODUCTS_COUNT;
        }

        return $this->_productsCount;
    }

    public function _prepareLayout()
    {

//        echo __METHOD__;
        $FeaturedStatus = Mage::getStoreConfig('sm_featured/sm_featured/enable');
//        var_dump($FeaturedStatus);
//        die();

        if($FeaturedStatus == 1){
            Mage::app()->getLayout()->getBlock('head')->addItem('skin_css', 'css/slider/lib/idangerous.swiper.css');
            $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/slider/lib/idangerous.swiper.js');
        }

        return parent::_prepareLayout();
    } // end _prepareLayout()
} // end class
// end file