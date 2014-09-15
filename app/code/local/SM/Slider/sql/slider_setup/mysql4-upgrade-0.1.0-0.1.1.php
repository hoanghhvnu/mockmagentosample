<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/15/14
 * Time: 10:56 AM
 */
//die('hoange');
//die($this->getTable('slider/slider'));
$installer = $this;
$installer->startSetup();

$installer->run("
    ALTER TABLE  {$this->getTable('slider/slider')}
    DROP COLUMN type

    ");

$installer->endSetup();