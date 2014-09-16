<?php

//$installer = $this;

$installer = Mage::getResourceModel('catalog/setup','catalog_setup');
//echo "<pre>";
//die(var_dump($installer));

$installer->startSetup();
$installer->addAttribute('catalog_product', 'is_featured', array(
    'type'              => 'int',
    'input'             => 'select',
    'label'             => 'Is featured',
    'option'            => array(
        array('label' => 'No', 'values' => '2'),
        array('label' => 'Yes', 'values' => '1'),

    ),

));

//die('run success');
$installer->endSetup(); 