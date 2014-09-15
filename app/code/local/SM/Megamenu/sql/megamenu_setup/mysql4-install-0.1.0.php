<?php

$installer = $this;
//$table = $this->getTable('megamenu/megamenu');
//die('ten bang la' . $table);

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('megamenu/megamenu')};
CREATE TABLE {$this->getTable('megamenu/megamenu')} (
  `megamenu_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) not null,
  `type` int(3) NOT NULL,
   `link` varchar(255),
   `category_id` int(10),
   `static_block_id` int(10),
   `position` int(2) default NULL,
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`megamenu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup(); 