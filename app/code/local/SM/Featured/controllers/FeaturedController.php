<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/16/14
 * Time: 8:31 AM
 */
class SM_Featured_FeaturedController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){

//        echo __METHOD__;
//        $featured = Mage::getModel('catalog/product')
//            ->getCollection()
//            ->addAttributeToSelect('is_featured')
//            ->addAttributeToSelect('thumbnail')
//            ->addAttributeToSelect('image')
//            ->addAttributeToFilter('is_featured',array('eq'=>1))
//        ;
        echo "<pre>";
//        var_dump($featured->getImageUrl());
        $collection = Mage::getModel('catalog/product')->getCollection()
//        $collection = Mage::getModel('catalog/product_collection');//->getCollection()

            ->addAttributeToSelect('is_featured')
            ->addAttributeToFilter('is_featured',array('eq'=>1))

        ;
//        var_dump($collection);
//        die();
        var_dump($collection->getSize());

//        $collection->addAttributeToSelect('*');
        echo "<pre>";
        foreach ($collection->getItems() as $product) {
            var_dump($product->getData());

            $prod = Mage::helper('catalog/product')->getProduct($product->getId(), null, null);

//            $attributes = $prod->getTypeInstance(true)->getSetAttributes($prod);

//            $galleryData = $prod->getData('media_gallery');
            $image = $prod->getData('image');
            var_dump($image);

//            foreach ($galleryData['images'] as &$image) {
//                var_dump($image);
//            }

        }
    }
} // end class
// end file