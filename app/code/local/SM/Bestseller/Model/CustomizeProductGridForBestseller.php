<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/17/14
 * Time: 9:01 PM
 */
class SM_Bestseller_Model_CustomizeProductGridForbestseller
{
    public function addBestsellerColumn(Varien_Event_Observer $observer)
    {
//        echo __METHOD__;
        $block = $observer->getBlock();
        if($block->getType() == 'adminhtml/catalog_product_grid'){
//        if ($block->getId() == 'productGrid'){
            $block->addColumnAfter('bestseller',
                array(
                    'header'=> Mage::helper('catalog')->__('Best seller'),
                    'width' => '70px',
                    'index' => 'bestseller',
                    'type'  => 'options',
                    'options' => array(
                        0 => 'No',
                        1 => 'Category',
                        2 => 'Home',
                    ),
                ),
                'action'
            );
        }

    } // end function

    public function addSelect(Varien_Event_Observer $observer){
        $collection = $observer->getCollection();
        $collection->addAttributeToSelect('bestseller');
    } // end method addFeaturedColumn

    public function addMassaction(Varien_Event_Observer $observer)
    {
//        echo __METHOD__;
        $block = $observer->getEvent()->getBlock();

        $bestsellerstatuses = array(
            array('label' => 'No', 'value' => '0'),
            array('label' => 'Category', 'value' => '1'),
            array('label' => 'Home', 'value' => '2'),
        );

        array_unshift($bestsellerstatuses, array('label'=>'', 'value'=>''));
        $block->getMassactionBlock()->addItem('bestseller', array(
            'label'=> Mage::helper('catalog')->__('Change Bestseller status'),
            'url'  => $block->getUrl('*/*/massBestseller', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'bestseller',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Bestseller'),
                    'values' => $bestsellerstatuses
                )
            )
        ));
//        }
    } // end method addMassaction()
} // end class
// end file