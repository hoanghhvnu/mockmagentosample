<?php

//$installer = $this;

$installer = Mage::getResourceModel('catalog/setup','catalog_setup');
//echo "<pre>";
//die(var_dump($installer));

$installer->startSetup();
$installer->removeAttribute('catalog_product', 'is_featured');


$installer->addAttribute('catalog_product', 'is_featured', array(
    'type'              => 'int',
    'input'             => 'select',
    'label'             => 'Is featured',
    'source'      => 'featured/featuredtype'

));
//die('run success');
$installer->endSetup();