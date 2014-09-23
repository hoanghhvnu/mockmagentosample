<?php

//$installer = $this;

$installer = Mage::getResourceModel('catalog/setup','catalog_setup');
//echo "<pre>";
//die(var_dump($installer));

$installer->startSetup();
//$installer->removeAttribute('catalog_product', 'is_featured');


$installer->addAttribute('catalog_product', 'bestseller', array(
    'type'              => 'int',
    'input'             => 'select',
    'label'             => 'Best seller',
    'source'      => 'bestseller/bestsellertype'

));
//die('run success');
$installer->endSetup();