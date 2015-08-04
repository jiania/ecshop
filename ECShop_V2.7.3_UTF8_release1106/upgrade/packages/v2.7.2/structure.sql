-- `ecs_shipping`修改
ALTER TABLE `ecs_shipping` ADD `print_bg` varchar(255) default NULL;
ALTER TABLE `ecs_shipping` ADD `config_lable` text, ADD `print_model` tinyint(1) default '0';


--`ecs_admin_action`修改
ALTER TABLE `ecs_admin_action` ADD `relevance` varchar(20) NOT NULL default '';


--`ecs_cart`修改
ALTER TABLE `ecs_cart` ADD `product_id` mediumint(8) unsigned NOT NULL default '0';

--`ecs_order_goods`修改
ALTER TABLE `ecs_order_goods` ADD `product_id` mediumint(8) unsigned NOT NULL default '0';

--`ecs_delivery_goods`修改
ALTER TABLE `ecs_delivery_goods` ADD `product_id` mediumint(8) unsigned NOT NULL default '0', ADD `product_sn` varchar(60) default NULL;

--`ecs_back_goods`修改
ALTER TABLE `ecs_back_goods` ADD `product_id` mediumint(8) unsigned NOT NULL default '0', ADD `product_sn` varchar(60) default NULL;

--`ecs_cart`修改
ALTER TABLE `ecs_cart` ADD `product_id` mediumint(8) unsigned NOT NULL default '0';

--`ecs_products`新增
DROP TABLE IF EXISTS `ecs_products`;
CREATE TABLE `ecs_products` (
  `product_id` mediumint(8) unsigned NOT NULL auto_increment,
  `goods_id` mediumint(8) unsigned NOT NULL default '0',
  `goods_attr` varchar(50) default NULL,
  `product_sn` varchar(60) default NULL,
  `product_number` smallint(5) unsigned default '0',
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM;

--`ecs_package_goods`修改
ALTER TABLE `ecs_package_goods` ADD `product_id` mediumint(8) unsigned NOT NULL, ADD PRIMARY KEY ( `package_id` , `goods_id` , `admin_id` , `product_id` );

--`ecs_goods_activity`修改
ALTER TABLE `ecs_goods_activity` ADD `product_id` mediumint(8) unsigned NOT NULL default '0';