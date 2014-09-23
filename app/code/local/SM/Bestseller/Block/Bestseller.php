<?php

/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/18/14
 * Time: 8:40 AM
 */
class SM_Bestseller_Block_Bestseller extends Mage_Catalog_Block_Product_New
{
    const LIMIT_BESTSELLER_PRODUCT = 5;

    protected $_productCount;

    public function getBestsellerProducts()
    {
        $storeId = (int)Mage::app()->getStore()->getId();

        // Date
        $myFromDate = Mage::getStoreConfig('sm_bestseller/sm_bestseller_source/fromdate');
        $myToDate = Mage::getStoreConfig('sm_bestseller/sm_bestseller_source/todate');

        $date = new Zend_Date();
        Zend_debug::dump($date->getDate()->get('Y-MM-dd'));
        die();
        $fromDate = $date->setDate($myFromDate)->get('Y-MM-dd');
        $toDate = $date->setDate($myToDate)->get('Y-MM-dd');
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addStoreFilter()
            ->addPriceData()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->setPageSize(6);

        $collection->getSelect()
            ->joinLeft(
                array('aggregation' => $collection->getResource()->getTable('sales/bestsellers_aggregated_yearly')),
                "e.entity_id = aggregation.product_id AND aggregation.store_id={$storeId} AND aggregation.period BETWEEN '{$fromDate}' AND '{$toDate}'",
                array('SUM(aggregation.qty_ordered) AS sold_quantity')
            )
            ->group('e.entity_id')
            ->order(array('sold_quantity DESC', 'e.created_at'));

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

        return $collection;
    }

    /**
     * Retrieve Bestseller product to show in frontend
     * @return mixed
     */
    public function myBest()
    {
        $storeId = Mage::app()->getStore()->getId();

        $HandleArray = Mage::app()->getLayout()->getUpdate()->getHandles();
        $CategoryHandle = 'catalog_category_view';

        $SourceConfig = Mage::getStoreConfig('sm_bestseller/sm_bestseller_source');
        if ($SourceConfig && ! empty($SourceConfig) ){
            $SourceType = $SourceConfig['timeperiod'];
            $date = new Zend_Date();
            /**
             * Select time range to retrive bestseller
             */
            if ($SourceType && $SourceType == 'specify') {
                $fromDate = $date->setDate($SourceConfig['fromdate'] )->get('Y-MM-dd');
                $toDate = $date->setDate($SourceConfig['todate'] )->get('Y-MM-dd');
            } else {
                /**
                 * use switch to return begin of week, month, year...
                 */
                switch ($SourceType) {
                    case 'subWeek':
                        $toDate = $date->subDay(
                            $date->getDate()->get('e') ) // return day of week in digit
                            ->getDate()
                            ->get('Y-MM-dd')
                        ;
                        break;
                    case 'subMonth':
                        $toDate = $date
                            ->setDay(1)
//                            ->subDay(
//                            $date->getDate()->get('dd') ) // return day of month in digit
                            ->getDate()
                            ->get('Y-MM-dd')
                        ;
                        break;
                    case 'subYear':
                        $toDate = $date->subDay(
                            $date->getDate()->get('D') ) // return day of year in digit
                            ->getDate()
                            ->get('Y-MM-dd')
                        ;
                        break;
                    default :
                        $toDate = $date->getDate()
                            ->get('Y-MM-dd')
                        ;
                } // end switch

                $subType = $SourceType;
                $unit = ($SourceConfig['unit']) ? $SourceConfig['unit'] : 1;
                $fromDate = $date->$subType($unit)->getDate()->get('Y-MM-dd');

            } // end else
            /**
             * Limit maximum product retrieve
             */
            $limit = $SourceConfig['limitproduct'];
            if ($limit > 0 && ctype_digit($limit)) {
                $this->setProductsCount($limit);
            }

            $products = Mage::getResourceModel('reports/product_collection')
                ->addOrderedQty($fromDate, $toDate) // filter by range of time
//            ->addOrderedQty()
                ->addAttributeToSelect('*')
                ->addAttributeToSelect(array('name', 'price', 'small_image'))
                ->setStoreId($storeId)
                ->addStoreFilter($storeId)
                ->setOrder('ordered_qty', 'desc'); // most best sellers on top
            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

            $products->setPageSize($limit)
                     ->setCurPage(1);
            if (in_array($CategoryHandle, $HandleArray)) {
                $CategoryId = Mage::getModel('catalog/layer')->getCurrentCategory()->getId();
                $CategoryModel = Mage::getModel('catalog/category')->load($CategoryId);
                $products->addCategoryFilter($CategoryModel);
            }

            return $products;
        } // end if sourceconfig
    } // end myBest()


    public function _prepareLayout()
    {
        $BestsellerStatus = Mage::getStoreConfig('sm_featured/sm_bestseller/enable');
        if ($BestsellerStatus == 1) {
            Mage::app()->getLayout()->getBlock('head')->addItem('skin_css', 'css/slider/lib/idangerous.swiper.css');
            $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/slider/lib/idangerous.swiper.js');
        }

        return parent::_prepareLayout();
    } // end _prepareLayout()

    public function getProductCount()
    {
        if (is_null($this->_productsCount)) {
            return self::LIMIT_BESTSELLER_PRODUCT;
        } else {
            return $this->_productsCount;
        }
    } // end getProductCount

    public function setProductCount($value = '')
    {
        if ($value && ctype_digit($value)) {
            $this->_productsCount = $value;
        }
        return TRUE;
    } // end setProductCount
} // end class
// end file