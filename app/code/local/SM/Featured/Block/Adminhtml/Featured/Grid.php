<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/17/14
 * Time: 11:54 PM
 */
class SM_Featured_Block_Adminhtml_Featured_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid{
    protected function _prepareColumns(){
        $this->addColumnAfter('featured',
            array(
                'header'=> Mage::helper('catalog')->__('is Featured'),
                'width' => '70px',
                'index' => 'is_featured',
                'type'  => 'options',
                'options' => array(
                    0 => 'No',
                    1 => 'Category',
                    2 => 'Home',
                ),
            ),
            'action'
        );
        return parent::_prepareColumns();
    } // end _PrepareColumn

//    protected function _prepareMassaction(){

//$featurestatuses = array(
//array('label' => 'No', 'value' => '0'),
//array('label' => 'Category', 'value' => '1'),
//array('label' => 'Home', 'value' => '2'),
//);
//
//        array_unshift($featurestatuses, array('label'=>'', 'value'=>''));
//        $this->getMassactionBlock()->addItem('featured', array(
//            'label'=> Mage::helper('catalog')->__('Change Featured status'),
//            'url'  => $this->getUrl('*/*/massFeatured', array('_current'=>true)),
//            'additional' => array(
//                'visibility' => array(
//                    'name' => 'featured',
//                    'type' => 'select',
//                    'class' => 'required-entry',
//                    'label' => Mage::helper('catalog')->__('Featured'),
//                    'values' => $featurestatuses
//                )
//            )
//        ));
//        return parent::_prepareMassaction();
//    } // end method _PrepareMassaction
//
//    protected function _prepareCollection()
//    {
//        $store = $this->_getStore();
//        $collection = Mage::getModel('catalog/product')->getCollection()
//            ->addAttributeToSelect('sku')
//            ->addAttributeToSelect('name')
//            ->addAttributeToSelect('attribute_set_id')
//            ->addAttributeToSelect('type_id')
//            ->addAttributeToSelect('is_featured');
//
//        if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
//            $collection->joinField('qty',
//                'cataloginventory/stock_item',
//                'qty',
//                'product_id=entity_id',
//                '{{table}}.stock_id=1',
//                'left');
//        }
//        if ($store->getId()) {
//            //$collection->setStoreId($store->getId());
//            $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
//            $collection->addStoreFilter($store);
//            $collection->joinAttribute(
//                'name',
//                'catalog_product/name',
//                'entity_id',
//                null,
//                'inner',
//                $adminStore
//            );
//            $collection->joinAttribute(
//                'custom_name',
//                'catalog_product/name',
//                'entity_id',
//                null,
//                'inner',
//                $store->getId()
//            );
//            $collection->joinAttribute(
//                'status',
//                'catalog_product/status',
//                'entity_id',
//                null,
//                'inner',
//                $store->getId()
//            );
//            $collection->joinAttribute(
//                'visibility',
//                'catalog_product/visibility',
//                'entity_id',
//                null,
//                'inner',
//                $store->getId()
//            );
//            $collection->joinAttribute(
//                'price',
//                'catalog_product/price',
//                'entity_id',
//                null,
//                'left',
//                $store->getId()
//            );
////            $collection->joinAttribute(
////                'is_featured',
////                'catalog_product/is_featured',
////                'entity_id',
////                null,
////                'inner',
////                $store->getId()
////            );
//        }
//        else {
//            $collection->addAttributeToSelect('price');
//            $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner');
//            $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner');
//        }
//
//        $this->setCollection($collection);
//
////        parent::_prepareCollection();
//        Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
//        $this->getCollection()->addWebsiteNamesToResult();
//        return $this;
//    }
}// end class
// end file