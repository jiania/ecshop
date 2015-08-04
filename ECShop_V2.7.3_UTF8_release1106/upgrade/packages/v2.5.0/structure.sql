-- 分类表增加样式的字段
ALTER TABLE `ecs_category` ADD `style` VARCHAR( 150 ) NOT NULL;

-- 增加办事处表
DROP TABLE IF EXISTS `ecs_agency`;
CREATE TABLE `ecs_agency` (
  `agency_id` smallint(5) unsigned NOT NULL auto_increment,
  `agency_name` varchar(255) NOT NULL,
  `agency_desc` text NOT NULL,
  PRIMARY KEY  (`agency_id`),
  KEY `agency_name` (`agency_name`)
) TYPE=MyISAM;

-- 管理员表增加字段：所属办事处
ALTER TABLE `ecs_admin_user` ADD `agency_id` SMALLINT UNSIGNED NOT NULL;
ALTER TABLE `ecs_admin_user` ADD INDEX ( `agency_id` );

-- 地区表增加字段：所属办事处
ALTER TABLE `ecs_region` ADD `agency_id` SMALLINT UNSIGNED NOT NULL;
ALTER TABLE `ecs_region` ADD INDEX ( `agency_id` );

-- 订单表增加字段：所属办事处
ALTER TABLE `ecs_order_info` ADD `agency_id` SMALLINT UNSIGNED NOT NULL;
ALTER TABLE `ecs_order_info` ADD INDEX ( `agency_id` );

-- 收藏表增加是否为关注商品的字段
ALTER TABLE `ecs_collect_goods` ADD `is_attention` TINYINT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `ecs_collect_goods` ADD INDEX ( `is_attention` );

-- 商品类型表增加属性分组的字段
ALTER TABLE `ecs_goods_type` ADD `attr_group` VARCHAR( 255 ) NOT NULL;

-- 商品属性表增加属性分组的字段
ALTER TABLE `ecs_attribute` ADD `attr_group` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

-- 增加搜索引擎爬虫统计表
DROP TABLE IF EXISTS `ecs_searchengine`;
CREATE TABLE `ecs_searchengine` (
  `date` date NOT NULL default '0000-00-00',
  `searchengine` varchar(20) NOT NULL default '',
  `count` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`date`,`searchengine`)
) TYPE=MyISAM;

-- 增加搜索引擎关键字统计表
DROP TABLE IF EXISTS `ecs_keywords`;
CREATE TABLE `ecs_keywords` (
  `date` date NOT NULL default '0000-00-00',
  `searchengine` varchar(20) NOT NULL default '',
  `keyword` varchar(90) NOT NULL default '',
  `count` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`date`,`searchengine`,`keyword`)
) TYPE=MyISAM;

-- 删除统计表中的关键字字段
ALTER TABLE `ecs_stats` DROP `keywords`;

-- 调整session表
DROP TABLE IF EXISTS `ecs_sessions`;
CREATE TABLE `ecs_sessions` (
  `sesskey` char(32) binary NOT NULL default '',
  `expiry` int(10) unsigned NOT NULL default '0',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `adminid` mediumint(8) unsigned NOT NULL default '0',
  `ip` char(15) NOT NULL default '',
  `data` char(255) NOT NULL default '',
  PRIMARY KEY (`sesskey`),
  KEY `expiry` (`expiry`)
) TYPE=HEAP;

-- 增加session数据表
DROP TABLE IF EXISTS `ecs_sessions_data`;
CREATE TABLE `ecs_sessions_data` (
`sesskey` varchar( 32 ) binary NOT NULL default '',
`expiry` int( 10 ) unsigned NOT NULL default '0',
`data` longtext NOT NULL ,
PRIMARY KEY ( `sesskey` ) ,
KEY `expiry` ( `expiry` )
) TYPE = MYISAM;

-- 增加计划任务表
DROP TABLE IF EXISTS `ecs_crons`;
CREATE TABLE `ecs_crons` (
  `cron_id` tinyint(3) unsigned NOT NULL auto_increment,
  `cron_code` varchar(20) NOT NULL,
  `cron_name` varchar(120) NOT NULL,
  `cron_desc` text,
  `cron_order` tinyint(3) unsigned NOT NULL default '0',
  `cron_config` text NOT NULL,
  `thistime` int(10) NOT NULL default '0',
  `nextime` int(10) NOT NULL,
  `day` tinyint(2) NOT NULL,
  `week` varchar(1) NOT NULL,
  `hour` varchar(2) NOT NULL,
  `minute` varchar(255) NOT NULL,
  `enable` tinyint(1) NOT NULL default '1',
  `run_once` tinyint(1) NOT NULL default '0',
  `allow_ip` varchar(100) NOT NULL default '',
  `alow_files` varchar(255) NOT NULL,
  PRIMARY KEY  (`cron_id`),
  KEY `nextime` (`nextime`),
  KEY `enable` (`enable`),
  KEY `cron_code` (`cron_code`)
) TYPE=MyISAM;

-- 增加错误日志表
DROP TABLE IF EXISTS `ecs_error_log`;
CREATE TABLE `ecs_error_log` (
  `id` int(10) NOT NULL auto_increment,
  `info` varchar(255) NOT NULL,
  `file` varchar(100) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `time` (`time`)
) TYPE=MyISAM;

-- 改商品属性的attr_select字段
ALTER TABLE `ecs_attribute` CHANGE `attr_select` `attr_input_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1';

-- 增加 todolist 字段
ALTER TABLE `ecs_admin_user` ADD `todolist` LONGTEXT NULL;

-- 增加商品活动表（换名字了，原来的表不用了，导完数据就删除）
-- --------------------------------------------------------
DROP TABLE IF EXISTS `ecs_goods_activity`;
CREATE TABLE `ecs_goods_activity` (
  `act_id` mediumint(8) unsigned NOT NULL auto_increment,
  `act_name` varchar(255) NOT NULL,
  `act_desc` text NOT NULL,
  `act_type` tinyint(3) unsigned NOT NULL,
  `goods_id` mediumint(8) unsigned NOT NULL,
  `goods_name` varchar(255) NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `is_finished` tinyint(3) unsigned NOT NULL,
  `ext_info` text NOT NULL,
  PRIMARY KEY  (`act_id`),
  KEY `act_name` (`act_name`,`act_type`,`goods_id`)
) TYPE=MyISAM;

-- 增加帐户变动记录表
DROP TABLE IF EXISTS `ecs_account_log`;
CREATE TABLE `ecs_account_log` (
  `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `user_money` decimal(10,2) NOT NULL,
  `frozen_money` decimal(10,2) NOT NULL,
  `rank_points` mediumint(9) NOT NULL,
  `pay_points` mediumint(9) NOT NULL,
  `change_time` int(10) unsigned NOT NULL,
  `change_desc` varchar(255) NOT NULL,
  `change_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `user_id` (`user_id`)
) TYPE=MyISAM;

-- 用户表增加字段：冻结资金
ALTER TABLE `ecs_users` ADD `frozen_money` DECIMAL( 10, 2 ) NOT NULL AFTER `user_money`;

-- 修改数据表中的时间格式
ALTER TABLE `ecs_ad` ADD `start_time` INT( 11 ) UNSIGNED NOT NULL AFTER `ad_code` ,
ADD `end_time` INT( 11 ) UNSIGNED NOT NULL AFTER `start_time`;

ALTER TABLE `ecs_admin_message` ADD `sent_time` INT( 11 ) UNSIGNED NOT NULL AFTER `receiver_id` ,
ADD `read_time` INT( 11 ) UNSIGNED NOT NULL AFTER `sent_time`;

ALTER TABLE `ecs_admin_user` ADD `add_time` INT( 11 ) UNSIGNED NOT NULL AFTER `password` ,
ADD `last_login` INT( 11 ) UNSIGNED NOT NULL AFTER `add_time`;

ALTER TABLE `ecs_bonus_type` ADD `send_start_date` INT( 11 ) UNSIGNED NOT NULL ,
ADD `send_end_date` INT( 11 ) UNSIGNED NOT NULL ,
ADD `use_start_date` INT( 11 ) UNSIGNED NOT NULL ,
ADD `use_end_date` INT( 11 ) UNSIGNED NOT NULL;

ALTER TABLE `ecs_collect_goods` ADD `add_time` INT( 11 ) UNSIGNED NOT NULL AFTER `goods_id`;

ALTER TABLE `ecs_goods` ADD `promote_start_date` INT( 11 ) UNSIGNED NOT NULL AFTER `promote_price` ,
ADD `promote_end_date` INT( 11 ) UNSIGNED NOT NULL AFTER `promote_start_date`;

ALTER TABLE `ecs_order_action` ADD `log_time` INT( 11 ) UNSIGNED NOT NULL;

ALTER TABLE `ecs_order_info` ADD `add_time` INT( 10 ) UNSIGNED NOT NULL AFTER `referer`;

ALTER TABLE `ecs_users` ADD `last_login` INT( 11 ) UNSIGNED NOT NULL AFTER `reg_time`;

ALTER TABLE `ecs_vote` ADD `start_time` INT( 11 ) UNSIGNED NOT NULL AFTER `vote_name` ,
ADD `end_time` INT( 11 ) UNSIGNED NOT NULL AFTER `start_time`;

-- 修改用户表，整合时记录用户状态
ALTER TABLE `ecs_users` ADD `flag` TINYINT UNSIGNED NOT NULL DEFAULT '0',
ADD `alias` VARCHAR( 60 ) NOT NULL;

ALTER TABLE `ecs_users` ADD INDEX ( `flag` );

-- 修改文章分类表，支持无级分类
ALTER TABLE `ecs_article_cat` ADD `parent_id` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `ecs_article_cat` ADD INDEX ( `parent_id` );

-- 文章分类名增加到255
ALTER TABLE `ecs_article_cat` CHANGE `cat_name` `cat_name` VARCHAR( 255 );

-- 删除留言的reply字段,添加order_id字段
ALTER TABLE `ecs_feedback` DROP `reply`;
ALTER TABLE `ecs_feedback` CHANGE `parend_id` `parent_id` MEDIUMINT( 8 ) UNSIGNED NOT NULL DEFAULT '0';

-- 增加拍卖活动出价记录表
DROP TABLE IF EXISTS `ecs_auction_log`;
CREATE TABLE `ecs_auction_log` (
  `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  `act_id` mediumint(8) unsigned NOT NULL,
  `bid_user` mediumint(8) unsigned NOT NULL,
  `bid_price` decimal(10,2) unsigned NOT NULL,
  `bid_time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `act_id` (`act_id`)
) TYPE=MyISAM;

-- 增加专题活动表
DROP TABLE IF EXISTS `ecs_topic`;
CREATE TABLE `ecs_topic` (
  `topic_id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '''''',
  `intro` text NOT NULL,
  `start_time` int(11) NOT NULL default '0',
  `end_time` int(10) NOT NULL default '0',
  `data` text NOT NULL,
  `template` varchar(255) NOT NULL default '''''',
  `css` text NOT NULL,
  KEY `topic_id` (`topic_id`)
) TYPE=MyISAM;



-- 商品分类增加是否启用的字段
ALTER TABLE `ecs_category` ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1';

-- 删除is_leaf
ALTER TABLE `ecs_category` DROP `is_leaf`;

-- 配置表增加排序的字段
ALTER TABLE `ecs_shop_config` ADD `sort_order` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '1';

-- 用户表扩展用户信息
ALTER TABLE `ecs_users` ADD `msn` VARCHAR( 60 ) NOT NULL ,
ADD `qq` VARCHAR( 20 ) NOT NULL,
ADD `office_phone` VARCHAR( 20 ) NOT NULL,
ADD `home_phone` VARCHAR( 20 ) NOT NULL,
ADD `mobile_phone` VARCHAR( 20 ) NOT NULL;

-- 增加优惠活动表
DROP TABLE IF EXISTS `ecs_favourable_activity`;
CREATE TABLE `ecs_favourable_activity` (
  `act_id` smallint(5) unsigned NOT NULL auto_increment,
  `act_name` varchar(255) NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `user_rank` varchar(255) NOT NULL,
  `act_range` tinyint(3) unsigned NOT NULL,
  `act_range_ext` varchar(255) NOT NULL,
  `min_amount` decimal(10,2) unsigned NOT NULL,
  `max_amount` decimal(10,2) unsigned NOT NULL,
  `act_type` tinyint(3) unsigned NOT NULL,
  `act_type_ext` decimal(10,2) unsigned NOT NULL,
  `gift` text NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`act_id`),
  KEY `act_name` (`act_name`)
) TYPE=MyISAM;

-- 购物车变化（对应优惠活动）
ALTER TABLE `ecs_cart` DROP `can_handsel`;
ALTER TABLE `ecs_cart` CHANGE `goods_price` `goods_price` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00';

-- 添加评论用户ID字段
ALTER TABLE `ecs_comment` ADD `user_id` INT(11) UNSIGNED NOT NULL DEFAULT '0';

-- 添加文章外部链接字段
ALTER TABLE `ecs_article` ADD `link` VARCHAR( 255 ) NOT NULL;

-- 增加模板布局备份注释
ALTER TABLE `ecs_template` ADD `remarks` VARCHAR( 30 ) NOT NULL ;
ALTER TABLE `ecs_template` ADD INDEX ( `remarks` ) ;

-- 增加用户户是否已验证
ALTER TABLE `ecs_users` ADD `is_validated` TINYINT UNSIGNED NOT NULL DEFAULT '0';

-- 将虚拟卡做为标准功能
CREATE TABLE IF NOT EXISTS `ecs_virtual_card` (
    `card_id` mediumint(8) NOT NULL auto_increment,
    `goods_id` mediumint(8) unsigned NOT NULL default '0',
    `card_sn` varchar(60) NOT NULL default '',
    `card_password` varchar(60) NOT NULL default '',
    `add_date` int(11) NOT NULL default '0',
    `end_date` int(11) NOT NULL default '0',
    `is_saled` tinyint(1) NOT NULL default '0',
    `order_sn` varchar(20) NOT NULL default '',
    `crc32` int(11) NOT NULL default '0',
    PRIMARY KEY  (`card_id`),
    KEY `goods_id` (`goods_id`),
    KEY `car_sn` (`card_sn`),
    KEY `is_saled` (`is_saled`)
    ) TYPE=MyISAM ;

-- 支付方式加入是否支持在线支付
ALTER TABLE `ecs_payment` ADD `is_online` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';

-- 增加留言关联的订单ID字段
ALTER TABLE `ecs_feedback` ADD `order_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0';

-- 红包类型表增加字段：订单最低金额
ALTER TABLE `ecs_bonus_type` ADD `min_goods_amount` DECIMAL( 10, 2 ) UNSIGNED NOT NULL ;

-- 解决多个管理员同时添加商品时冲突的问题
ALTER TABLE `ecs_link_goods` ADD `admin_id` TINYINT UNSIGNED NOT NULL ;
ALTER TABLE `ecs_group_goods` ADD `admin_id` TINYINT UNSIGNED NOT NULL ;
ALTER TABLE `ecs_goods_article` ADD `admin_id` TINYINT UNSIGNED NOT NULL ;
ALTER TABLE `ecs_group_goods` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `parent_id` , `goods_id` , `admin_id` );
ALTER TABLE `ecs_link_goods` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `goods_id` , `link_goods_id` , `admin_id` );
ALTER TABLE `ecs_goods_article` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `goods_id` , `article_id` , `admin_id` );

-- 会员表增加信用额度字段
ALTER TABLE `ecs_users` ADD `credit_line` DECIMAL( 10, 2 ) UNSIGNED NOT NULL ;

-- 商品表增加商品名称样式字段
ALTER TABLE `ecs_goods` ADD `goods_name_style` VARCHAR( 255 ) NOT NULL DEFAULT '+' AFTER `goods_name` ;

-- 订单表增加发票类型及税额字段
ALTER TABLE `ecs_order_info` ADD `inv_type` VARCHAR( 60 ) NOT NULL ,
ADD `tax` DECIMAL( 10, 2 ) NOT NULL ;

-- 商品表增加送多少积分字段
ALTER TABLE `ecs_goods` ADD `give_integral` INT UNSIGNED NOT NULL;

-- 商品表删除字段
ALTER TABLE `ecs_goods` DROP `can_handsel`;
ALTER TABLE `ecs_goods` DROP `fitting_price`;
ALTER TABLE `ecs_goods` DROP `is_linked`;
ALTER TABLE `ecs_goods` DROP `is_basic`;
ALTER TABLE `ecs_goods` DROP `is_gift`;

-- 增加批发商品表
DROP TABLE IF EXISTS `ecs_wholesale`;
CREATE TABLE `ecs_wholesale` (
  `act_id` mediumint(8) unsigned NOT NULL auto_increment,
  `goods_id` mediumint(8) unsigned NOT NULL,
  `goods_name` varchar(255) NOT NULL,
  `rank_ids` varchar(255) NOT NULL,
  `prices` text NOT NULL,
  `enabled` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`act_id`),
  KEY `goods_id` (`goods_id`)
) TYPE=MYISAM ;

-- 增加发送队列表
DROP TABLE IF EXISTS `ecs_email_sendlist`;
CREATE TABLE  `ecs_email_sendlist` (
 `id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `email` VARCHAR( 100 ) NOT NULL ,
 `template_id` MEDIUMINT( 8 ) NOT NULL ,
 `email_content` TEXT NOT NULL ,
 `error` TINYINT( 1 ) NOT NULL DEFAULT  '0' ,
 `pri` TINYINT( 10 ) NOT NULL ,
 `last_send` INT( 10 ) NOT NULL
) TYPE = MYISAM ;

-- 增加电子杂志订阅表
DROP TABLE IF EXISTS `ecs_email_list`;
CREATE TABLE `ecs_email_list` (
  `id` mediumint(8) NOT NULL auto_increment,
  `email` varchar(60) NOT NULL,
  `stat` tinyint(1) NOT NULL default '0',
  `hash` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

ALTER TABLE `ecs_mail_templates` ADD `type` VARCHAR( 10 ) NOT NULL ;
ALTER TABLE `ecs_mail_templates` ADD INDEX ( `type` ) ;
UPDATE  `ecs_mail_templates` SET type='template';

ALTER TABLE `ecs_mail_templates` DROP INDEX `template_code`;
ALTER TABLE `ecs_mail_templates` ADD INDEX ( `template_code` );

-- 增加自动处理的表
DROP TABLE IF EXISTS `ecs_auto_manage`;
CREATE TABLE `ecs_auto_manage` (
  `item_id` mediumint(8) NOT NULL,
  `type` varchar(10) NOT NULL,
  `starttime` int(10) NOT NULL,
  `endtime` int(10) NOT NULL,
  PRIMARY KEY  (`item_id`,`type`)
) TYPE=MyISAM;

ALTER TABLE `ecs_order_info` ADD `parent_id` mediumint(8) unsigned NOT NULL default '0';
ALTER TABLE `ecs_order_info` ADD `is_separate` tinyint(1) NOT NULL default '0';
ALTER TABLE `ecs_order_info` ADD INDEX ( `is_separate` ) ;

-- 增加分成信息纪录
DROP TABLE IF EXISTS `ecs_affiliate_log`;
CREATE TABLE  `ecs_affiliate_log` (
 `log_id` MEDIUMINT( 8 ) NOT NULL auto_increment,
 `order_id` MEDIUMINT( 8 ) NOT NULL ,
 `time` INT( 10 ) NOT NULL ,
 `user_id` MEDIUMINT( 8 ) NOT NULL,
 `user_name` varchar(60),
 `money` DECIMAL(10,2) NOT NULL DEFAULT '0',
 `point` INT(10) NOT NULL DEFAULT '0',
 `separate_type` TINYINT(1) NOT NULL DEFAULT '0',
PRIMARY KEY ( `log_id` )
) TYPE = MYISAM ;
ALTER TABLE `ecs_affiliate_log` ADD `separate_by` tinyint(1) NOT NULL default '0';

-- 增加价格分级及过滤属性
ALTER TABLE `ecs_category` ADD `grade` tinyint(4) NOT NULL default '0';
ALTER TABLE `ecs_category` ADD `filter_attr` smallint(6) NOT NULL default 0;

-- 增加`goods_attr_id`
ALTER TABLE `ecs_cart` ADD `goods_attr_id` mediumint(8) NOT NULL;
ALTER TABLE `ecs_cart` ADD `can_handsel` tinyint(3) unsigned NOT NULL default '0';

-- 增加 自定义导航栏 表
DROP TABLE IF EXISTS `ecs_nav`;
CREATE TABLE `ecs_nav` (
  `id` mediumint(8) NOT NULL auto_increment,
  `ctype` VARCHAR( 10 ) NULL,
  `cid` SMALLINT( 5 ) UNSIGNED NULL,
  `name` varchar(255) NOT NULL,
  `ifshow` tinyint(1) NOT NULL,
  `vieworder` tinyint(1) NOT NULL,
  `opennew` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `ifshow` (`ifshow`)
) TYPE=MyISAM;
--  ALTER TABLE `ecs_nav` ADD `ctype` VARCHAR( 10 ) NULL AFTER `id` ,
--  ADD `cid` SMALLINT( 5 ) UNSIGNED NULL AFTER `ctype` ;

-- 用户表增加上级id
ALTER TABLE `ecs_users` ADD `parent_id` mediumint(8) unsigned NOT NULL;

-- 用户id的类型加大
ALTER TABLE `ecs_admin_user` CHANGE `user_id` `user_id` SMALLINT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT;

-- 广告字段增加默认值
ALTER TABLE `ecs_ad` CHANGE `ad_link` `ad_link` VARCHAR( 255 ) NOT NULL default '';
ALTER TABLE `ecs_ad` CHANGE `start_time` `start_time` int(11 ) NOT NULL default '0';
ALTER TABLE `ecs_ad` CHANGE `end_time` `end_time` int( 11 ) NOT NULL default '0';
ALTER TABLE `ecs_ad` CHANGE `link_phone` `link_phone` VARCHAR( 60 ) NOT NULL default '';

-- admin_message设定字段默认值
ALTER TABLE `ecs_admin_message` CHANGE `sent_time` `sent_time` int(11 ) NOT NULL default '0';
ALTER TABLE `ecs_admin_message` CHANGE `read_time` `read_time` int(11 ) NOT NULL default '0';

-- admin_user设定字段默认值
ALTER TABLE `ecs_admin_user` CHANGE `add_time` `add_time` int(11 ) NOT NULL default '0';
ALTER TABLE `ecs_admin_user` CHANGE `last_login` `last_login` int(11 ) NOT NULL default '0';

-- 文章链接设定默认值
ALTER TABLE `ecs_article` CHANGE `link` `link` varchar(255 ) NOT NULL default '';
 
-- 文章分类名称设定默认值
ALTER TABLE `ecs_article_cat` CHANGE `cat_name` `cat_name` varchar(255 ) NOT NULL default '';

-- bounds_type设定默认值
ALTER TABLE `ecs_bonus_type` CHANGE `send_start_date` `send_start_date` int(11) NOT NULL default '0';
ALTER TABLE `ecs_bonus_type` CHANGE `send_end_date` `send_end_date` int(11) NOT NULL default '0';
ALTER TABLE `ecs_bonus_type` CHANGE `use_start_date` `use_start_date` int(11) NOT NULL default '0';
ALTER TABLE `ecs_bonus_type` CHANGE `use_end_date` `use_end_date` int(11) NOT NULL default '0';
ALTER TABLE `ecs_bonus_type` CHANGE `min_goods_amount` `min_goods_amount` decimal(10,2) unsigned NOT NULL default '0.00';

-- booking_goods设定默认值
ALTER TABLE `ecs_booking_goods` CHANGE `tel` `tel` varchar(60) NOT NULL default '';

-- 购物车设定默认值
ALTER TABLE `ecs_cart` CHANGE `session_id` `session_id` char(32) binary NOT NULL default '';
ALTER TABLE `ecs_cart` CHANGE `is_gift` `is_gift` smallint(5) unsigned NOT NULL default '0';
ALTER TABLE `ecs_cart` CHANGE `can_handsel` `can_handsel` tinyint(3) unsigned NOT NULL default '0';

-- 分类表设定默认值
ALTER TABLE `ecs_category` CHANGE `cat_name` `cat_name` varchar(90) NOT NULL default '';

-- collect_goods设定默认值
ALTER TABLE `ecs_collect_goods` CHANGE `add_time` `add_time` int(11) unsigned NOT NULL default '0';

-- 商品表字段添加默认值
ALTER TABLE `ecs_goods` CHANGE `promote_start_date` `promote_start_date` int(11) unsigned NOT NULL default '0';
ALTER TABLE `ecs_goods` CHANGE `promote_end_date` `promote_end_date` int(11) unsigned NOT NULL default '0';
ALTER TABLE `ecs_goods` CHANGE `give_integral` `give_integral` int(10) NOT NULL default '-1';
ALTER TABLE `ecs_goods` DROP INDEX `promote_start`;
ALTER TABLE `ecs_goods` DROP INDEX `promote_end`;
ALTER TABLE `ecs_goods` ADD INDEX (`promote_start_date`) ;
ALTER TABLE `ecs_goods` ADD INDEX (`promote_end_date`) ;

-- 商品文章表字段添加默认值
ALTER TABLE `ecs_goods_article` CHANGE `admin_id` `admin_id` tinyint(3) unsigned NOT NULL default '0';

-- 配件表字段添加默认值
ALTER TABLE `ecs_group_goods` CHANGE `admin_id` `admin_id` tinyint(3) unsigned NOT NULL default '0';

-- link_goods表添加默认值
ALTER TABLE `ecs_link_goods` CHANGE `admin_id` `admin_id` tinyint(3) unsigned NOT NULL default '0';

-- 邮件模板表添加唯一索引
ALTER TABLE `ecs_mail_templates` ADD UNIQUE (`template_code`);

-- 订单操作表字段添加默认值
ALTER TABLE `ecs_order_action` CHANGE `log_time` `log_time` int(11) unsigned NOT NULL default '0';

-- 订单商品表添加默认值
ALTER TABLE `ecs_order_goods` CHANGE `is_gift` `is_gift` smallint(5) unsigned NOT NULL default '0';

-- 订单信息表添加默认值
ALTER TABLE `ecs_order_info` CHANGE `address` `address` varchar(255) NOT NULL default '';
ALTER TABLE `ecs_order_info` CHANGE `zipcode` `zipcode` varchar(60) NOT NULL default '';
ALTER TABLE `ecs_order_info` CHANGE `tel` `tel` varchar(60) NOT NULL default '';
ALTER TABLE `ecs_order_info` CHANGE `mobile` `mobile` varchar(60) NOT NULL default '';
ALTER TABLE `ecs_order_info` CHANGE `add_time` `add_time` int(10) unsigned NOT NULL default '0';
ALTER TABLE `ecs_order_info` CHANGE `pay_note` `pay_note` varchar(255) NOT NULL default '';

-- 支付日志表添加默认值
ALTER TABLE `ecs_pay_log` CHANGE `order_amount` `order_amount` decimal(10,2) unsigned NOT NULL;

-- 支付方式添加默认值
ALTER TABLE `ecs_payment` CHANGE `pay_fee` `pay_fee` varchar(10) NOT NULL default '0';
ALTER TABLE `ecs_payment` CHANGE `is_online` `is_online` tinyint(1) unsigned NOT NULL default '0';

-- 配送表修改默认值
ALTER TABLE `ecs_shipping` CHANGE `insure` `insure` varchar(10) NOT NULL default '0';

-- 模板设置默认值
ALTER TABLE `ecs_template` CHANGE `remarks` `remarks` varchar(30) NOT NULL default '';

-- 用户地址设置默认值
ALTER TABLE `ecs_user_address` CHANGE `zipcode` `zipcode` varchar(60) NOT NULL default '';
ALTER TABLE `ecs_user_address` CHANGE `tel` `tel` varchar(60) NOT NULL default '';
ALTER TABLE `ecs_user_address` CHANGE `mobile` `mobile` varchar(60) NOT NULL default '';

-- 用户表设置默认值
ALTER TABLE `ecs_users` CHANGE `frozen_money` `frozen_money` decimal(10,2) NOT NULL default '0.00';
ALTER TABLE `ecs_users` CHANGE `last_login` `last_login` int(11) unsigned NOT NULL default '0';
ALTER TABLE `ecs_users` CHANGE `parent_id` `parent_id` mediumint(9) NOT NULL default '0';
ALTER TABLE `ecs_users` DROP INDEX `user_name`;
ALTER TABLE `ecs_users` ADD UNIQUE (`user_name`);
ALTER TABLE `ecs_users` ADD INDEX (`parent_id`);

-- 投票表设置默认值
ALTER TABLE `ecs_vote` CHANGE `start_time` `start_time` int(11) unsigned NOT NULL default '0';
ALTER TABLE `ecs_vote` CHANGE `end_time` `end_time` int(11) unsigned NOT NULL default '0';
ALTER TABLE `ecs_admin_user` CHANGE `user_id` `user_id` SMALLINT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT;

-- 支持负id
ALTER TABLE `ecs_article_cat` CHANGE `cat_id` `cat_id` SMALLINT( 5 ) NOT NULL AUTO_INCREMENT;
ALTER TABLE `ecs_article` CHANGE `cat_id` `cat_id` SMALLINT( 5 ) NOT NULL DEFAULT '0';

-- 订单表增加“折扣”字段
ALTER TABLE `ecs_order_info` ADD `discount` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0';

--Mail最后发送
ALTER TABLE `ecs_mail_templates` ADD `last_send` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `last_modify` ;

-- 修改红包序号类型
ALTER TABLE `ecs_user_bonus` CHANGE `bonus_sn` `bonus_sn` BIGINT( 20 ) UNSIGNED NOT NULL DEFAULT '0';