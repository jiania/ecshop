-- 修改 cart 表
ALTER TABLE `ecs_cart` CHANGE `goods_attr_id` `goods_attr_id` VARCHAR( 60 ) NOT NULL DEFAULT '';

-- 增加商品批量购买优惠价格表
DROP TABLE IF EXISTS `ecs_volume_price`;
CREATE TABLE IF NOT EXISTS `ecs_volume_price` (
  `price_type` tinyint(1) unsigned NOT NULL,
  `goods_id` mediumint(8) unsigned NOT NULL,
  `volume_number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `volume_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`price_type`,`goods_id`,`volume_number`)
) ENGINE=MyISAM;

-- 修改 feedback 表
ALTER TABLE `ecs_feedback` ADD `msg_status` TINYINT( 1 ) unsigned NOT NULL DEFAULT '0' AFTER `msg_type`;

-- 增加超值礼包商品表
DROP TABLE IF EXISTS `ecs_package_goods`;
CREATE TABLE `ecs_package_goods` (
  `package_id` mediumint( 8 ) unsigned NOT NULL DEFAULT '0',
  `goods_id` mediumint( 8 ) unsigned NOT NULL DEFAULT '0',
  `goods_number` smallint( 5 ) unsigned NOT NULL DEFAULT '1',
  `admin_id` tinyint( 3 ) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY ( `package_id` , `goods_id` , `admin_id` )
) ENGINE = MyISAM;

-- 增加积分商城商品表
DROP TABLE IF EXISTS `ecs_exchange_goods`;
CREATE TABLE IF NOT EXISTS `ecs_exchange_goods` (
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `exchange_integral` int(10) unsigned NOT NULL DEFAULT '0',
  `is_exchange` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM;
