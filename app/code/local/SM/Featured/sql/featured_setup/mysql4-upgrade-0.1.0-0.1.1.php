<?php

//$installer = $this;

$installer = Mage::getResourceModel('catalog/setup','catalog_setup');
//echo "<pre>";
//die(var_dump($installer));

$installer->startSetup();
$installer->removeAttribute('catalog_product', 'is_featured');


$installer->addAttribute('catalog_product', 'is_featured', array(
    'type'              => 'int',
    'input'             => 'boolean',
    'label'             => 'Is featured',
    'option'            => array(
        'values' => array(
            1 => 'Yes',
            0 => 'No',
        ),

    ),
));
//die('run success');
$installer->endSetup();