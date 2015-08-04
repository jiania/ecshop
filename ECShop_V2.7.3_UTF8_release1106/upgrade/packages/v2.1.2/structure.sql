ALTER TABLE `ecs_template` ADD `theme` VARCHAR( 30 ) NOT NULL FIRST;
ALTER TABLE `ecs_template` ADD INDEX ( `theme` );

ALTER TABLE `ecs_category` CHANGE `cat_name` `cat_name` VARCHAR( 180 ) NOT NULL ;

CREATE TABLE  IF NOT EXISTS `ecs_group_buy` (
                `group_buy_id` mediumint(8) unsigned NOT NULL auto_increment,
                `goods_id` mediumint(8) unsigned NOT NULL default '0',
                `start_date` int(11) unsigned NOT NULL default '0',
                `end_date` int(11) unsigned NOT NULL default '0',
                `price_ladder` varchar(255) NOT NULL,
                `restrict_amount` smallint(6) unsigned NOT NULL default '0',
                `group_buy_desc` text NOT NULL,.
                `trans_amount` smallint(6) unsigned NOT NULL default '0',
                `trans_price` decimal(10,2) NOT NULL default '0.00',.
                `gift_integral` smallint(5) unsigned NOT NULL default '0',
                `pay_process` tinyint(1) unsigned NOT NULL default '0',
                PRIMARY KEY  (`group_buy_id`),
                KEY `goods_id` (`goods_id`),
                KEY `pay_process` (`pay_process`)
                ) TYPE=MyISAM ;

-- 虚拟卡增加字段（因为是插件，所以只有存在此表时才执行）
-- ALTER TABLE `ecs_virtual_card` ADD `crc32` INT NOT NULL DEFAULT '0';

-- 因为from_ad的值有-1的情况,所以允许from_ad的值为负数
ALTER TABLE `ecs_order_info` 
  CHANGE `from_ad` `from_ad` SMALLINT( 5 ) NOT NULL DEFAULT '0';

ALTER TABLE `ecs_adsense` 
  CHANGE `from_ad` `from_ad`  SMALLINT( 5 ) NOT NULL DEFAULT '0';

ALTER TABLE `ecs_ad` 
  CHANGE `ad_code` `ad_code` TEXT NOT NULL ;
