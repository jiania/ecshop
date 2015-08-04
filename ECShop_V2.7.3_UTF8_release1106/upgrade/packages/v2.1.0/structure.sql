ALTER TABLE `ecs_activity`
   CHANGE `activity_id` `activity_id` smallint(5) unsigned NOT NULL auto_increment,
   CHANGE `start_time` `start_time` int(10) unsigned NOT NULL default '0',
   CHANGE `end_time` `end_time` int(10) unsigned NOT NULL default '0';


ALTER TABLE `ecs_ad`
   CHANGE `position_id` `position_id` tinyint(3) unsigned NOT NULL,
   CHANGE `link_email` `link_email` varchar(60) NOT NULL default '',
   CHANGE `link_phone` `link_phone` varchar(20) NOT NULL default '';


ALTER TABLE `ecs_admin_action`
   CHANGE `action_id` `action_id` tinyint(3) unsigned NOT NULL auto_increment,
   CHANGE `parent_id` `parent_id` tinyint(3) unsigned NOT NULL default '0';


ALTER TABLE `ecs_admin_log`
   CHANGE `log_id` `log_id` int(10) unsigned NOT NULL auto_increment,
   CHANGE `log_time` `log_time` int(10) unsigned NOT NULL default '0',
   CHANGE `user_id` `user_id` tinyint(3) unsigned NOT NULL default '0';


ALTER TABLE `ecs_admin_message`
   CHANGE `message_id` `message_id` smallint(5) unsigned NOT NULL auto_increment,
   CHANGE `sender_id` `sender_id` tinyint(3) unsigned NOT NULL default '0',
   CHANGE `receiver_id` `receiver_id` tinyint(3) unsigned NOT NULL default '0',
   ADD INDEX `receiver_id` (`receiver_id`);


DROP TABLE IF EXISTS `ecs_adsense`;
CREATE TABLE `ecs_adsense` (
  `from_ad` smallint(5) unsigned NOT NULL default '0',
  `referer` varchar(255) NOT NULL default '',
  `clicks` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`from_ad`,`referer`)
) TYPE=MyISAM;


ALTER TABLE `ecs_article`
  CHANGE `content` `content` longtext NOT NULL,
  CHANGE `add_time` `add_time` int(10) unsigned NOT NULL default '0',
  ADD `file_url` varchar(255) NOT NULL default '',
  ADD `open_type` tinyint(1) unsigned NOT NULL default '0',
  ADD INDEX `title` (`title`);

  
ALTER TABLE `ecs_article_cat`
  CHANGE `is_open` `show_in_nav` tinyint(1) unsigned NOT NULL default '0',
  DROP INDEX `is_open`;


ALTER TABLE `ecs_attribute`
  CHANGE `attr_id` `attr_id` smallint(5) unsigned NOT NULL auto_increment,
  CHANGE `cat_id` `cat_id` smallint(5) unsigned NOT NULL default '0',
  ADD `attr_index` tinyint(1) unsigned NOT NULL default '0',
  CHANGE `sort_order` `sort_order` tinyint(3) unsigned NOT NULL default '0',
  ADD `is_linked` tinyint(1) unsigned NOT NULL default '0';


ALTER TABLE  `ecs_booking_goods`
  CHANGE `user_id` `user_id` mediumint(8) unsigned NOT NULL default '0',
  CHANGE `email` `email` varchar(60) NOT NULL default '',
  CHANGE `tel` `tel` varchar(20) NOT NULL default '',
  CHANGE `goods_id` `goods_id` mediumint(8) unsigned NOT NULL default '0',
  CHANGE `goods_number` `goods_number` smallint(5) unsigned NOT NULL default '0',
  CHANGE `booking_time` `booking_time` int(10) unsigned NOT NULL default '0',
  CHANGE `dispose_time` `dispose_time` int(10) unsigned NOT NULL default '0',
  DROP INDEX `user_id`,
  ADD INDEX `user_id` (`user_id`);


ALTER TABLE `ecs_brand`
  CHANGE `site_url` `site_url` varchar(255) NOT NULL default '',
  CHANGE `sort_order` `sort_order` tinyint(3) unsigned NOT NULL default '0';


ALTER TABLE `ecs_card`
  CHANGE `card_name` `card_name` varchar(120) NOT NULL default '';


ALTER TABLE  `ecs_cart`
  CHANGE `goods_id` `goods_id` mediumint(8) unsigned NOT NULL default '0',
  CHANGE `goods_sn`  `goods_sn` varchar(60) NOT NULL default '',
  CHANGE `parent_id`  `parent_id` mediumint(8) unsigned NOT NULL default '0';


ALTER TABLE  `ecs_category`
  CHANGE `cat_id` `cat_id` smallint(6) unsigned NOT NULL auto_increment,
  DROP INDEX `show_in_nav`,
  DROP INDEX `is_leaf`;


ALTER TABLE `ecs_comment`
  CHANGE `email` `email` varchar(60) NOT NULL default '',
  CHANGE `add_time` `add_time` int(10) unsigned NOT NULL default '0',
  CHANGE `parent_id` `parent_id` int(10) unsigned NOT NULL default '0',
  DROP INDEX `status`;


ALTER TABLE `ecs_feedback`
  CHANGE `msg_time` `msg_time` int(10) unsigned NOT NULL default '0',
  CHANGE `reply` `reply` tinyint(1) unsigned NOT NULL default '0',
  ADD  `message_img` varchar(255) NOT NULL default '';


ALTER TABLE `ecs_friend_link`
  CHANGE `link_url` `link_url` varchar(255) NOT NULL default '';


ALTER TABLE `ecs_goods`
  CHANGE `cat_id` `cat_id` smallint(6) unsigned NOT NULL default '0',
  CHANGE `click_count` `click_count` int(10) unsigned NOT NULL default '0',
  CHANGE `brand_id` `brand_id` smallint(5) unsigned NOT NULL default '0',
  CHANGE `goods_number` `goods_number` smallint(5) unsigned NOT NULL default '0',
  CHANGE `warn_number` `warn_number` tinyint(3) unsigned NOT NULL default '1',
  CHANGE `add_time` `add_time` int(10) unsigned NOT NULL default '0',
  CHANGE `is_best` `is_best` tinyint(1) unsigned NOT NULL default '0',
  CHANGE `is_new` `is_new` tinyint(1) unsigned NOT NULL default '0',
  CHANGE `is_hot` `is_hot` tinyint(1) unsigned NOT NULL default '0',
  CHANGE `is_promote` `is_promote` tinyint(1) unsigned NOT NULL default '0',
  CHANGE `bonus_type_id` `bonus_type_id` tinyint(3) unsigned NOT NULL default '0',
  CHANGE `last_update` `last_update` int(10) unsigned NOT NULL default '0',
  CHANGE `goods_type` `goods_type` smallint(5) unsigned NOT NULL default '0',
  ADD `seller_note` varchar(255) NOT NULL default '',
  ADD `cycle_img` varchar(255) NOT NULL default '',
  DROP INDEX  `goods_name`,
  DROP INDEX  `goods_type`,
  DROP INDEX  `cat_id`,
  DROP INDEX  `brand_id_3` ,
  DROP INDEX  `is_on_sale`,
  DROP INDEX  `is_linked`,
  DROP INDEX  `is_basic` ,
  DROP INDEX  `is_gift`,
  DROP INDEX  `is_delete`,
  DROP INDEX  `is_best` ,
  DROP INDEX  `is_new`,
  DROP INDEX  `is_hot` ,
  DROP INDEX  `is_promote`,
  DROP INDEX  `promote_price`,
  ADD INDEX `last_update` (`last_update`),
  ADD INDEX `promote_price` (`promote_price`),
  ADD INDEX `brand_id` (`brand_id`),
  ADD INDEX `goods_weight` (`goods_weight`),
  ADD INDEX `market_price` (`market_price`),
  ADD INDEX `promote_end` (`promote_end`),
  ADD INDEX `promote_start` (`promote_start`),
  ADD INDEX `shop_price` (`shop_price`),
  ADD INDEX `fitting_price` (`fitting_price`),
  ADD INDEX `goods_number` (`goods_number`);


DROP TABLE IF EXISTS `ecs_goods_article`;
CREATE TABLE `ecs_goods_article` (
  `goods_id` mediumint(8) unsigned NOT NULL default '0',
  `article_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`goods_id`,`article_id`)
) TYPE=MyISAM;


ALTER TABLE `ecs_goods_attr`
  CHANGE `goods_attr_id` `goods_attr_id` int(10) unsigned NOT NULL auto_increment;


ALTER TABLE `ecs_goods_cat`
  CHANGE `cat_id` `cat_id` smallint(5) unsigned NOT NULL default '0';


ALTER TABLE `ecs_member_price`
  CHANGE `user_rank` `user_rank` tinyint(3) NOT NULL default '0';


ALTER TABLE  `ecs_order_info`
  CHANGE `consignee` `consignee` varchar(60) NOT NULL default '',
  CHANGE `country` `country` smallint(5) unsigned NOT NULL default '0',
  CHANGE `province` `province` smallint(5) unsigned NOT NULL default '0',
  CHANGE `city` `city` smallint(5) unsigned NOT NULL default '0',
  CHANGE `district` `district` smallint(5) unsigned NOT NULL default '0',
  CHANGE `address` `address` varchar(120) NOT NULL default '',
  CHANGE `tel` `tel` varchar(20) NOT NULL default '',
  CHANGE `mobile` `mobile` varchar(20) NOT NULL default '',
  CHANGE `best_time` `best_time` varchar(120) NOT NULL default '',
  CHANGE `shipping_id` `shipping_id` tinyint(3) NOT NULL default '0',
  CHANGE `shipping_name` `shipping_name` varchar(120) NOT NULL default '',
  CHANGE `pay_id` `pay_id` tinyint(3) NOT NULL default '0',
  CHANGE `pay_name` `pay_name` varchar(120) NOT NULL default '',
  CHANGE `integral` `integral` smallint(5) unsigned NOT NULL default '0.00',
  CHANGE `from_ad` `from_ad` smallint(5) unsigned NOT NULL default '0',
  CHANGE `pay_time` `pay_time` int(10) unsigned NOT NULL default '0',
  CHANGE `shipping_time` `shipping_time` int(10) unsigned NOT NULL default '0',
  CHANGE `pack_id` `pack_id` tinyint(3) unsigned NOT NULL default '0',
  CHANGE `card_id` `card_id` tinyint(3) unsigned NOT NULL default '0',
  ADD `integral_money` decimal(10,2) NOT NULL default '0.00',
  ADD `extension_code` varchar(30) NOT NULL default '',
  ADD `extension_id` mediumint(8) unsigned NOT NULL default '0',
  ADD `to_buyer` varchar(255) NOT NULL default '',
  ADD INDEX `extension_code` (`extension_code`,`extension_id`);


ALTER TABLE `ecs_pack`
  CHANGE `pack_name` `pack_name` varchar(120) NOT NULL default '';


DROP TABLE IF EXISTS `ecs_plugins`;
CREATE TABLE `ecs_plugins` (
  `code` varchar(30) NOT NULL default '',
  `version` varchar(10) NOT NULL default '',
  `library` varchar(255) NOT NULL default '',
  `assign` tinyint(1) unsigned NOT NULL default '0',
  `install_date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`code`)
) TYPE=MyISAM;


ALTER TABLE `ecs_repay`
  CHANGE `apply_time` `apply_time` int(10) unsigned NOT NULL default '0';


ALTER TABLE `ecs_shipping_area`
  CHANGE `shipping_area_id` `shipping_area_id` smallint(5) unsigned NOT NULL auto_increment,
  CHANGE `shipping_id` `shipping_id` tinyint(3) unsigned NOT NULL default '0';


ALTER TABLE `ecs_shop_config`
  CHANGE  `value` `value` text NOT NULL;


ALTER TABLE `ecs_snatch`
  CHANGE `activity_id` `activity_id` smallint(5) unsigned NOT NULL default '0',
  CHANGE `integral` `integral` smallint(5) unsigned NOT NULL default '0';


ALTER TABLE `ecs_snatch_log`
  CHANGE `log_id` `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  CHANGE `snatch_id` `snatch_id` tinyint(3) unsigned NOT NULL default '0',
  CHANGE `user_id` `user_id` mediumint(8) unsigned NOT NULL default '0',
  CHANGE `bid_time` `bid_time` int(10) unsigned NOT NULL default '0';


ALTER TABLE `ecs_stats`
  CHANGE `log_id` `log_id` int(10) unsigned NOT NULL auto_increment,
  CHANGE `visit_times` `visit_times` smallint(5) unsigned NOT NULL default '1',
  CHANGE `access_url` `access_url` varchar(255) NOT NULL default '',
  CHANGE `access_time` `access_time` int(10) unsigned NOT NULL default '0';


DROP TABLE IF EXISTS `ecs_tag`;
CREATE TABLE `ecs_tag` (
  `tag_id` mediumint(8) NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `goods_id` mediumint(8) unsigned NOT NULL default '0',
  `tag_words` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`tag_id`),
  KEY `user_id` (`user_id`,`goods_id`)
) TYPE=MyISAM;



ALTER TABLE `ecs_user_address`
  CHANGE `country` `country` smallint(5) NOT NULL default '0',
  CHANGE `province` `province` smallint(5) NOT NULL default '0',
  CHANGE `city` `city` smallint(5) NOT NULL default '0',
  CHANGE `district` `district` smallint(5) NOT NULL default '0',
  CHANGE `tel` `tel` varchar(20) NOT NULL default '',
  CHANGE `mobile` `mobile` varchar(20) NOT NULL default '';


ALTER TABLE `ecs_user_bonus`
  CHANGE `used_time` `used_time` int(10) unsigned NOT NULL default '0';


ALTER TABLE `ecs_user_rank`
  CHANGE `rank_id` `rank_id` tinyint(3) unsigned NOT NULL auto_increment;


ALTER TABLE `ecs_users`
  CHANGE  `address_id` `address_id` mediumint(8) unsigned NOT NULL default '0',
  CHANGE `reg_time` `reg_time` int(10) unsigned NOT NULL default '0',
  CHANGE `user_rank`  `user_rank` tinyint(3) unsigned NOT NULL default '0';


ALTER TABLE `ecs_vote_log`
  CHANGE `vote_time` `vote_time` int(10) unsigned NOT NULL default '0';