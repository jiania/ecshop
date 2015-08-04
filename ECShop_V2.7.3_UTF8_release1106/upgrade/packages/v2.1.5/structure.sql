ALTER TABLE `ecs_activity` 
    CHANGE `name` `name` VARCHAR( 120 ) NOT NULL;

ALTER TABLE `ecs_ad` 
    CHANGE `position_id` `position_id` SMALLINT UNSIGNED NOT NULL DEFAULT '0',
    CHANGE `ad_link` `ad_link` VARCHAR( 255 ) NOT NULL,
    CHANGE `link_phone` `link_phone` VARCHAR( 60 ) NOT NULL,
    DROP INDEX `enabled`;

ALTER TABLE `ecs_admin_message` 
    DROP INDEX `sender_id`,
    ADD INDEX (`sender_id` , `receiver_id` );

ALTER TABLE `ecs_admin_user` 
    DROP INDEX `password`;

ALTER TABLE `ecs_article` 
    DROP INDEX `title`;

ALTER TABLE `ecs_article`
    DROP INDEX `cat_id`;

ALTER TABLE `ecs_article`
    ADD INDEX `cat_id` (`cat_id`);

ALTER TABLE `ecs_attribute` 
    DROP INDEX `attr_select`,
    DROP INDEX `sort_order`;

ALTER TABLE `ecs_bonus_type` 
    CHANGE `type_id` `type_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ecs_booking_goods` 
    CHANGE `tel` `tel` VARCHAR( 60 ) NOT NULL;

ALTER TABLE `ecs_brand` 
    DROP INDEX `sort_order`;

ALTER TABLE `ecs_cart` 
    DROP INDEX `parent_id`;

ALTER TABLE `ecs_category` 
    CHANGE `cat_name` `cat_name` VARCHAR( 90 ) NOT NULL,
    DROP INDEX `sort_order`;

ALTER TABLE `ecs_feedback` 
    CHANGE `msg_type` `msg_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
    DROP INDEX `user_name`,
    DROP INDEX `parend_id`,
    DROP INDEX `msg_type`,
    ADD INDEX ( `user_id` );

ALTER TABLE `ecs_cart` CHANGE `is_save` `rec_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `ecs_gift` 
    CHANGE `gift_type_id` `gift_type_id` SMALLINT UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `ecs_gift_type` 
    CHANGE `gift_type_id` `gift_type_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ecs_goods` 
    DROP INDEX `promote_price`,
    DROP INDEX `market_price`,
    DROP INDEX `shop_price`,
    DROP INDEX `fitting_price`;

ALTER TABLE `ecs_group_buy` 
    CHANGE `price_ladder` `price_ladder` TEXT NOT NULL,
    DROP INDEX `pay_process`;

ALTER TABLE `ecs_mail_templates` 
    DROP INDEX `template_code` ,
    ADD UNIQUE `template_code` ( `template_code` );

ALTER TABLE `ecs_order_action` 
    DROP INDEX `order_id`,
    ADD INDEX ( `order_id` );

ALTER TABLE `ecs_order_info` 
    CHANGE `zipcode` `zipcode` VARCHAR( 60 ) NOT NULL,
    CHANGE `tel` `tel` VARCHAR( 60 ) NOT NULL,
    CHANGE `mobile` `mobile` VARCHAR( 60 ) NOT NULL,
    CHANGE `address` `address` VARCHAR( 255 ) NOT NULL;

ALTER TABLE `ecs_snatch` 
    DROP INDEX `activity_id` ,
    ADD INDEX `goods_id` ( `goods_id` );

ALTER TABLE `ecs_tag` 
    DROP INDEX `user_id`,
    ADD INDEX ( `user_id` ),
    ADD INDEX ( `goods_id` );

ALTER TABLE `ecs_users` 
    CHANGE `pay_points` `pay_points` INT UNSIGNED NOT NULL DEFAULT '0',
    CHANGE `rank_points` `rank_points` INT UNSIGNED NOT NULL DEFAULT '0',
    DROP INDEX `email`,
    ADD INDEX ( `email` ),
    ADD INDEX ( `user_name` );

ALTER TABLE `ecs_user_address` 
    CHANGE `zipcode` `zipcode` VARCHAR( 60 ) NOT NULL,
    CHANGE `tel` `tel` VARCHAR( 60 ) NOT NULL,
    CHANGE `mobile` `mobile` VARCHAR( 60 ) NOT NULL;

ALTER TABLE `ecs_user_bonus` 
    DROP INDEX `bonus_type_id`;

ALTER TABLE `ecs_vote` 
    CHANGE `vote_id` `vote_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ecs_vote_log` 
    CHANGE `vote_id` `vote_id` SMALLINT UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `ecs_vote_option` 
    CHANGE `vote_id` `vote_id` SMALLINT UNSIGNED NOT NULL DEFAULT '0',
    ADD INDEX ( `vote_id` );

--增加会员余额(预付款)表
DROP TABLE IF EXISTS `ecs_user_account`;
CREATE TABLE `ecs_user_account` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `admin_user` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `add_time` int(10) NOT NULL default '0',
  `paid_time` int(10) NOT NULL default '0',
  `admin_note` varchar(255) NOT NULL,
  `user_note` varchar(255) NOT NULL,
  `process_type` tinyint(1) NOT NULL default '0',
  `payment` varchar(90) NOT NULL,
  `is_paid` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `is_paid` (`is_paid`)
) TYPE=MyISAM;

--增加支付记录log表
DROP TABLE IF EXISTS `ecs_pay_log`;
CREATE TABLE `ecs_pay_log` (
  `log_id` int(10) unsigned NOT NULL auto_increment,
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `order_amount` decimal(10,2) NOT NULL,
  `order_type` tinyint(1) unsigned NOT NULL default '0',
  `is_paid` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`log_id`)
) TYPE=MyISAM;

--配送保价
ALTER TABLE `ecs_shipping` 
    ADD `insure` VARCHAR( 10 ) NOT NULL DEFAULT '0.00' AFTER `shipping_desc`;

--支付费用
ALTER TABLE `ecs_payment` 
    ADD `pay_fee` VARCHAR( 10 ) NOT NULL DEFAULT '0.00' AFTER `pay_name`;

--订单中增加保价费用、支付费用、已付款金额、确认时间
ALTER TABLE `ecs_order_info` 
    ADD `insure_fee` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00' AFTER `shipping_fee` ,
    ADD `pay_fee` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00' AFTER `insure_fee`,
    ADD `money_paid` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00' AFTER `order_amount`,
    ADD `confirm_time` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `referer` ;

--stats表的变动，去掉 log_id，加上 access_time 索引
ALTER TABLE `ecs_stats` 
    DROP `log_id`, 
    ADD INDEX ( `access_time` );

--sessions 表的变动，去掉 `expireref`, 加上 userid, adminid, ip
ALTER TABLE `ecs_sessions` 
    DROP `expireref`, 
    ADD `ip` VARCHAR(15) NOT NULL DEFAULT '' AFTER `expiry` ,
    CHANGE `expiry` `expiry` INT(10) UNSIGNED NOT NULL DEFAULT '0',
    ADD `userid` mediumint(8) UNSIGNED NOT NULL default '0' AFTER `ip` ,
    ADD `adminid` mediumint(8) UNSIGNED NOT NULL default '0' AFTER `expiry`;

-- 品牌表增加是否显示的字段
ALTER TABLE `ecs_brand` 
    ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1',
    ADD INDEX ( `is_show` );

-- 团购表增加字段：保证金和活动是否结束
ALTER TABLE `ecs_group_buy` ADD `deposit` DECIMAL( 10, 2 ) UNSIGNED NOT NULL ,
    ADD `is_finished` TINYINT( 1 ) UNSIGNED NOT NULL ;

-- 修改购物车表的字段“商品属性”的类型
ALTER TABLE `ecs_cart` CHANGE `goods_attr` `goods_attr` TEXT NOT NULL ;

-- 修改订单商品表的字段“商品属性”的类型
ALTER TABLE `ecs_order_goods` CHANGE `goods_attr` `goods_attr` TEXT NOT NULL ;

-- 广告表增加索引
ALTER TABLE `ecs_ad` ADD INDEX ( `enabled` );

-- 修改赠品表的主键
ALTER TABLE `ecs_gift` DROP PRIMARY KEY;
ALTER TABLE `ecs_gift` DROP INDEX `gift_type_id`;
ALTER TABLE `ecs_gift` ADD PRIMARY KEY ( `gift_type_id` , `goods_id` );

-- 修改赠品活动名称的长度
ALTER TABLE `ecs_gift_type` CHANGE `gift_type_name` `gift_type_name` VARCHAR( 255 ) NOT NULL;

-- 修改积分字段大小
ALTER TABLE `ecs_user_rank` CHANGE `min_points` `min_points` INT UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `ecs_user_rank` CHANGE `max_points` `max_points` INT UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `ecs_group_buy` CHANGE `gift_integral` `gift_integral` INT UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `ecs_goods` CHANGE `integral` `integral` INT UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `ecs_order_info` CHANGE `integral` `integral` INT UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `ecs_snatch` CHANGE `integral` `integral` INT UNSIGNED NOT NULL DEFAULT '0';

-- 删除红包类型表中的使用总数以及发放总数2个字段
ALTER TABLE `ecs_bonus_type` DROP `send_count` , DROP `use_count` ;

-- 订单表增加付款备注字段
ALTER TABLE `ecs_order_info` ADD `pay_note` VARCHAR( 255 ) NOT NULL ;

-- 红包表增加是否发送邮件字段
ALTER TABLE `ecs_user_bonus` ADD `emailed` TINYINT UNSIGNED NOT NULL DEFAULT '0';

-- 购物车和订单商品表的 is_gift 字段从“是否赠品”改为“赠品类型”
ALTER TABLE `ecs_cart` CHANGE `is_gift` `is_gift` SMALLINT UNSIGNED NOT NULL ;
ALTER TABLE `ecs_order_goods` CHANGE `is_gift` `is_gift` SMALLINT UNSIGNED NOT NULL ;