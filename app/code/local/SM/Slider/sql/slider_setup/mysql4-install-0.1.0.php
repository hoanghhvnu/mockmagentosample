<?php

$installer = $this;
//echo $this->getTable('slider/imageslider');
//die();
//$table = $this->getTable('slider/slider');
//die('ten bang la' . $table);

$installer->startSetup();

$installer->run("

 DROP TABLE IF EXISTS {$this->getTable('slider/slider')};
 DROP TABLE IF EXISTS {$this->getTable('slider/imageslider')};
 DROP TABLE IF EXISTS {$this->getTable('slider/mapslider')};

CREATE TABLE {$this->getTable('slider/slider')} (
  `slider_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) not null,
  `type` varchar(255),
  `status` smallint(6) NOT NULL default '1',
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$this->getTable('slider/imageslider')} (
  `image_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `sortorder` int(11) NOT NULL default 999,
  `imagename` varchar(255) NOT NULL,
  `description` text,
  `slider_id` int(11),
  `status` smallint(6) NOT NULL default '1',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$this->getTable('slider/mapslider')} (
  `map_id` int(11) unsigned NOT NULL auto_increment,
  `slider_id` int(11) NOT NULL,
   `image_id` int(11) NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup(); 