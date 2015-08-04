-- 发货分单
ALTER TABLE `ecs_admin_user` ADD `suppliers_id` SMALLINT(5) UNSIGNED DEFAULT '0' NOT NULL AFTER `agency_id`;

ALTER TABLE `ecs_order_info` CHANGE `invoice_no` `invoice_no` varchar(255) DEFAULT NULL;

ALTER TABLE `ecs_cart` CHANGE `goods_attr_id` `goods_attr_id` VARCHAR(255) NOT NULL DEFAULT '';

-- 发货单商品表 `ecs_delivery_goods`
DROP TABLE IF EXISTS `ecs_delivery_goods`;
CREATE TABLE `ecs_delivery_goods` (
  `rec_id` mediumint(8) unsigned NOT NULL auto_increment,
  `delivery_id` mediumint(8) unsigned NOT NULL default '0',
  `goods_id` mediumint(8) unsigned NOT NULL default '0',
  `goods_name` varchar(120) default NULL,
  `brand_name` varchar(60) default NULL,
  `goods_sn` varchar(60) default NULL,
  `is_real` tinyint(1) unsigned default '0',
  `extension_code` varchar(30) default NULL,
  `parent_id` mediumint(8) unsigned default '0',
  `send_number` smallint(5) unsigned default '0',
  PRIMARY KEY  (`rec_id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM;

-- 发货单表 `ecs_delivery_order`
DROP TABLE IF EXISTS `ecs_delivery_order`;
CREATE TABLE `ecs_delivery_order` (
  `delivery_id` mediumint(8) unsigned NOT NULL auto_increment,
  `delivery_sn` varchar(20) NOT NULL,
  `order_sn` varchar(20) NOT NULL,
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `invoice_no` varchar(50) default NULL,
  `add_time` int(10) unsigned default '0',
  `shipping_id` tinyint(3) unsigned default '0',
  `shipping_name` varchar(120) default NULL,
  `user_id` mediumint(8) unsigned default '0',
  `action_user` varchar(30) default NULL,
  `consignee` varchar(60) default NULL,
  `address` varchar(250) default NULL,
  `country` smallint(5) unsigned default '0',
  `province` smallint(5) unsigned default '0',
  `city` smallint(5) unsigned default '0',
  `district` smallint(5) unsigned default '0',
  `sign_building` varchar(120) default NULL,
  `email` varchar(60) default NULL,
  `zipcode` varchar(60) default NULL,
  `tel` varchar(60) default NULL,
  `mobile` varchar(60) default NULL,
  `best_time` varchar(120) default NULL,
  `postscript` varchar(255) default NULL,
  `how_oos` varchar(120) default NULL,
  `insure_fee` decimal(10,2) unsigned default '0.00',
  `shipping_fee` decimal(10,2) unsigned default '0.00',
  `update_time` int(10) unsigned default '0',
  `suppliers_id` smallint(5) default '0',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `agency_id` smallint(5) unsigned default '0',
  PRIMARY KEY  (`delivery_id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM;

-- 退货单商品表 `ecs_back_goods`
DROP TABLE IF EXISTS `ecs_back_goods`;
CREATE TABLE `ecs_back_goods` (
  `rec_id` mediumint(8) unsigned NOT NULL auto_increment,
  `back_id` mediumint(8) unsigned default '0',
  `goods_id` mediumint(8) unsigned NOT NULL default '0',
  `goods_name` varchar(120) default NULL,
  `brand_name` varchar(60) default NULL,
  `goods_sn` varchar(60) default NULL,
  `is_real` tinyint(1) unsigned default '0',
  `extension_code` varchar(30) default NULL,
  `parent_id` mediumint(8) unsigned default '0',
  `send_number` smallint(5) unsigned default '0',
  PRIMARY KEY  (`rec_id`),
  KEY `back_id` (`back_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM;

-- 退货单表 `ecs_back_order`
DROP TABLE IF EXISTS `ecs_back_order`;
CREATE TABLE `ecs_back_order` (
  `back_id` mediumint(8) unsigned NOT NULL auto_increment,
  `delivery_sn` varchar(20) NOT NULL,
  `order_sn` varchar(20) NOT NULL,
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `invoice_no` varchar(50) default NULL,
  `add_time` int(10) unsigned default '0',
  `shipping_id` tinyint(3) unsigned default '0',
  `shipping_name` varchar(120) default NULL,
  `user_id` mediumint(8) unsigned default '0',
  `action_user` varchar(30) default NULL,
  `consignee` varchar(60) default NULL,
  `address` varchar(250) default NULL,
  `country` smallint(5) unsigned default '0',
  `province` smallint(5) unsigned default '0',
  `city` smallint(5) unsigned default '0',
  `district` smallint(5) unsigned default '0',
  `sign_building` varchar(120) default NULL,
  `email` varchar(60) default NULL,
  `zipcode` varchar(60) default NULL,
  `tel` varchar(60) default NULL,
  `mobile` varchar(60) default NULL,
  `best_time` varchar(120) default NULL,
  `postscript` varchar(255) default NULL,
  `how_oos` varchar(120) default NULL,
  `insure_fee` decimal(10,2) unsigned default '0.00',
  `shipping_fee` decimal(10,2) unsigned default '0.00',
  `update_time` int(10) unsigned default '0',
  `suppliers_id` smallint(5) default '0',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `return_time` int(10) unsigned default '0',
  `agency_id` smallint(5) unsigned default '0',
  PRIMARY KEY  (`back_id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM;


-- 供货商
DROP TABLE IF EXISTS `ecs_suppliers`;
CREATE TABLE `ecs_suppliers` (
  `suppliers_id` smallint(5) unsigned NOT NULL auto_increment,
  `suppliers_name` varchar(255) default NULL,
  `suppliers_desc` mediumtext,
  PRIMARY KEY  (`suppliers_id`)
) ENGINE=MyISAM;


-- 首页主广告用户自定义表 `ecs_ad_custom`
DROP TABLE IF EXISTS `ecs_ad_custom`;
CREATE TABLE `ecs_ad_custom` (
`ad_id` MEDIUMINT( 8 ) UNSIGNED NOT NULL auto_increment,
`ad_type` TINYINT( 1 ) UNSIGNED DEFAULT '1' NOT NULL ,
`ad_name` VARCHAR( 60 ) ,
`add_time` INT( 10 ) UNSIGNED DEFAULT '0' NOT NULL ,
`content` mediumtext,
`url` varchar(255) ,
`ad_status` TINYINT( 0 ) UNSIGNED DEFAULT '0' NOT NULL ,
PRIMARY KEY ( `ad_id` )
)ENGINE=MyISAM;


-- 用户注册项自定义信息表 `ecs_reg_extend_info`
DROP TABLE IF EXISTS `ecs_reg_extend_info`;
CREATE TABLE `ecs_reg_extend_info` (
  `Id` int(10) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `reg_field_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM;


-- 用户注册项自定义字段表 `ecs_reg_fields`
DROP TABLE IF EXISTS `ecs_reg_fields`;
CREATE TABLE `ecs_reg_fields` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `reg_field_name` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 修改 pack 表
ALTER TABLE `ecs_pack` CHANGE `pack_fee` `pack_fee` decimal(6,2) unsigned NOT NULL default '0';

