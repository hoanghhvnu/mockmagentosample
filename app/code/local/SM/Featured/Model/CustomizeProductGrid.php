<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/17/14
 * Time: 9:01 PM
 */
class SM_Featured_Model_CustomizeProductGrid{
    public function addFeaturedColumn(Varien_Event_Observer $observer){
        $block = $observer->getBlock();
        if($block->getId() == 'productGrid'){
            $block->addColumnAfter('featured',
                array(
                    'header'=> Mage::helper('catalog')->__('is Featured'),
                    'width' => '70px',
                    'index' => 'is_featured',
                    'type'  => 'options',
                    'options' => array(
                        0 => 'No',
                        1 => 'Yes',
                    ),
                ),
                'action'
            );
        } // end if
    } // end method addFeaturedColumn

    public function addSelect(Varien_Event_Observer $observer){
        $collection = $observer->getCollection();
        $collection->addAttributeToSelect('is_featured');
    } // end method addFeaturedColumn

    public function addMassaction(Varien_Event_Observer $observer){
        $block = $observer->getEvent()->getBlock();

        $featurestatuses = array(
            array('label' => 'No', 'value' => '0'),
            array('label' => 'Yes', 'value' => '1'),
        );

        array_unshift($featurestatuses, array('label'=>'', 'value'=>''));
        $block->getMassactionBlock()->addItem('featured', array(
            'label'=> Mage::helper('catalog')->__('Change Featured status'),
            'url'  => $block->getUrl('*/*/massFeatured', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'featured',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Featured'),
                    'values' => $featurestatuses
                )
            )
        ));
//        }
    } // end method addMassaction()
} // end class
// end file