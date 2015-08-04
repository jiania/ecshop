-- 修改 sessions 表
DROP TABLE IF EXISTS `ecs_sessions`;
CREATE TABLE `ecs_sessions` (
  `sesskey` char(32) binary NOT NULL default '',
  `expiry` int(10) unsigned NOT NULL default '0',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `adminid` mediumint(8) unsigned NOT NULL default '0',
  `ip` char(15) NOT NULL default '',
  `user_name` varchar(60) NOT NULL,
  `user_rank` tinyint(3) NOT NULL,
  `discount` decimal(3,2) NOT NULL,
  `email` varchar(60) NOT NULL,
  `data` char(255) NOT NULL default '',
  PRIMARY KEY  (`sesskey`),
  KEY `expiry` (`expiry`)
) ENGINE=MEMORY ;

-- 商品分类表增加 show_in_index 字段
ALTER TABLE `ecs_category` ADD `show_in_index` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `show_in_nav` ;

-- 留言表增加 msg_area 留言区域字段
ALTER TABLE `ecs_feedback` ADD `msg_area` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

-- 增加分类首页推荐表
DROP TABLE IF EXISTS `ecs_cat_recommend`;
CREATE TABLE `ecs_cat_recommend` (
  `cat_id` smallint(5) NOT NULL,
  `recommend_type` tinyint(1) NOT NULL,
  PRIMARY KEY  (`cat_id`,`recommend_type`)
) TYPE=MyISAM;

-- 增加后台设定返回等级积分数量
ALTER TABLE `ecs_goods` ADD `rank_integral` INT( 8 ) NOT NULL DEFAULT '-1';

-- 增加快递单打印模板
ALTER TABLE `ecs_shipping` ADD `shipping_print` TEXT NOT NULL;