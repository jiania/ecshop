ALTER TABLE  `ecs_category`
  CHANGE `cat_id` `cat_id` smallint(6) unsigned NOT NULL auto_increment;

ALTER TABLE `ecs_order_info` 
  CHANGE `from_ad` `from_ad` SMALLINT( 5 ) NOT NULL DEFAULT '0';

ALTER TABLE `ecs_adsense` 
  CHANGE `from_ad` `from_ad`  SMALLINT( 5 ) NOT NULL DEFAULT '0';