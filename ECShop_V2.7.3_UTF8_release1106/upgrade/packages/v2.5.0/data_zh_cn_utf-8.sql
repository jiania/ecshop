-- 增加办事处管理的权限
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (NULL, 4, 'agency_manage');
-- 添加专题管理的权限
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (NULL, 2, 'topic_manage');

INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value`, `sort_order` )
VALUES (
'223', '2', 'timezone', 'options', '-12,-11,-10,-9,-8,-7,-6,-5,-4,-3.5,-3,-2,-1,0,1,2,3,3.5,4,4.5,5,5.5,5.75,6,6.5,7,8,9,9.5,10,11,12', '', '8', 1
),
(121, 1, 'shop_notice', 'textarea', '', '', '商店公告', '1'),
(224, 2, 'upload_size_limit', 'options', '0,64,128,256,512,1024,2048,4096', '', '0', '1'),
(226, 2, 'cron_method', 'select', '0,1', '', '0', 1),
(227, 2, 'comment_factor', 'select', '0,1,2,3', '', '0', '1'),
(228, 2, 'enable_order_check', 'select', '0,1', '', '0', '1'),
(229, 2, 'default_storage', 'text', '', '', '1', '1'),
(326, 3, 'name_of_region_1', 'text', '', '', '国家', '1'),
(327, 3, 'name_of_region_2', 'text', '', '', '省', '1'),
(328, 3, 'name_of_region_3', 'text', '', '', '市', '1'),
(329, 3, 'name_of_region_4', 'text', '', '', '区', '1'),
(330, 3, 'search_keywords', 'text', '', '', '', 0),
(332, 3, 'related_goods_number', 'text', '', '', '4', '1'),
(420, 4, 'min_goods_amount', 'text', '', '', '0', '1'),
(421, 4, 'one_step_buy', 'select', '1,0', '', '0', '1'),
(422, 4, 'invoice_type', 'manual', '', '', '', '1'),
(423, 4, 'stock_dec_time', 'select', '1,0', '', '0', '1'),
(424, 4, 'cart_confirm', 'options', '1,2,3,4', '', '3', '0'),
(507, 5, 'mail_service', 'select', '0,1', '', '0', 0),
(616, 6, 'affiliate', 'hidden', '', '', 'a:3:{s:6:"config";a:7:{s:6:"expire";d:24;s:11:"expire_unit";s:4:"hour";s:11:"separate_by";i:0;s:15:"level_point_all";s:2:"5%";s:15:"level_money_all";s:2:"1%";s:18:"level_register_all";i:2;s:17:"level_register_up";i:60;}s:4:"item";a:4:{i:0;a:2:{s:11:"level_point";s:3:"60%";s:11:"level_money";s:3:"60%";}i:1;a:2:{s:11:"level_point";s:3:"30%";s:11:"level_money";s:3:"30%";}i:2;a:2:{s:11:"level_point";s:2:"7%";s:11:"level_money";s:2:"7%";}i:3;a:2:{s:11:"level_point";s:2:"3%";s:11:"level_money";s:2:"3%";}}s:2:"on";i:0;}', 1),
(617, 6, 'captcha', 'hidden', '', '', '0', 1),
(618, 6, 'captcha_width', 'hidden', '', '', '100', 1),
(619, 6, 'captcha_height', 'hidden', '', '', '20', 1),
(9, 0, 'wap', 'group', '', '', '', 1),
(901, 9, 'wap_config', 'select', '1,0', '', '0', 1),
(902, 9, 'wap_logo', 'file', '', '../images/', '', 1),
( 231, 2, 'visit_stats', 'select', 'on,off', '', 'on', '1' );

-- 增加调节会员帐户的权限
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (NULL, 3, 'account_manage');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (NULL, 5, 'flash_manage');

-- 文章无级分类
INSERT INTO `ecs_article_cat` (`cat_id`, `cat_name`, `cat_type`, `keywords`, `cat_desc`, `sort_order`, `parent_id`) VALUES (NULL, '系统分类', 2, '', '系统保留分类', 0, 0);
INSERT INTO `ecs_article_cat` (`cat_id`, `cat_name`, `cat_type`, `keywords`, `cat_desc`, `sort_order`, `parent_id`) VALUES (NULL, '网店信息', 3, '', '网店信息分类', 0, 0);
INSERT INTO `ecs_article_cat` (`cat_id`, `cat_name`, `cat_type`, `keywords`, `cat_desc`, `sort_order`, `parent_id`) VALUES (NULL, '网店帮助分类', 4, '', '网店帮助分类', 0, 0);

-- 商店设置中，隐藏某些设置
UPDATE `ecs_shop_config` SET `parent_id` = 6 WHERE `code` IN ('group_goods_number', 'best_number', 'new_number', 'hot_number', 'promote_number');

-- 邮件验证
DELETE FROM `ecs_mail_templates`  WHERE template_code = 'virtual_card';
INSERT INTO `ecs_mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `type`) VALUES
(NULL, 'register_validate', 1, '邮件验证', '{$user_name}您好！<br><br>\r\n\r\n这封邮件是 {$shop_name} 发送的。你收到这封邮件是为了验证你注册邮件地址是否有效。如果您已经通过验证了，请忽略这封邮件。<br>\r\n请点击以下链接(或者复制到您的浏览器)来验证你的邮件地址:<br>\r\n<a href="{$validate_email}" target="_blank">{$validate_email}</a><br><br>\r\n\r\n{$shop_name}<br>\r\n{$send_date}', 0, 'template');
INSERT INTO `ecs_mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `type`) VALUES
(NULL, 'virtual_card', 0, '虚拟卡片', '亲爱的{$order.consignee}\r\n你好！您的订单{$order.order_sn}中{$goods.goods_name} 商品的详细信息如下:\r\n{foreach from=$virtual_card item=card}\r\n{if $card.card_sn}卡号：{$card.card_sn}{/if}{if $card.card_password}卡片密码：{$card.card_password}{/if}{if $card.end_date}截至日期：{$card.end_date}{/if}\r\n{/foreach}\r\n再次感谢您对我们的支持。欢迎您的再次光临。\r\n\r\n{$shop_name}\r\n{$send_date}', 0, 'template');
INSERT INTO `ecs_mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `type`) VALUES
(NULL, 'remind_of_new_order', 0, '新订单通知', '亲爱的店长，您好：\n   快来看看吧，又有新订单了。订单金额为{$order.order_amount}，收货人是{$order.consignee}，地址是{$order.address}，电话是{$order.tel} {$order.mobile}。\n\n               系统提醒\n               {$send_date}', 0, 'template');

UPDATE `ecs_mail_templates` SET template_content = '亲爱的{$order.consignee}。你好！\r\n\r\n您的订单{$order.order_sn}已于{$send_time}按照您预定的配送方式给您发货了。\r\n\r\n{if $order.invoice_no}发货单号是{$order.invoice_no}。{/if}\r\n\r\n在您收到货物之后请点击下面的链接确认您已经收到货物：\r\n{$confirm_url}\r\n如果您还没有收到货物可以点击以下链接给我们留言：\r\n{$send_msg_url}\r\n\r\n再次感谢您对我们的支持。欢迎您的再次光临。 \r\n\r\n{$shop_name}\r\n{$send_date}' WHERE template_code = 'deliver_notice';

-- 更新支付插件
UPDATE `ecs_payment` SET is_online = 1 WHERE pay_code IN ('alipay','cappay','ctopay','ips','kuaiqian','nps','pay800','paypal','paypalcn','tenpay','udpay','xpay','yeepay','dodolink');

-- 缩略图背景色
INSERT INTO `ecs_shop_config` (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order`)
VALUES ('230', '2', 'bgcolor', 'text', '', '', '#FFFFFF', '0');

-- 自定义导航栏
INSERT INTO `ecs_nav` (`id`, `name`, `ifshow`, `vieworder`, `opennew`, `url`, `type`) VALUES
(1, '用户中心', 1, 1, 0, 'user.php', 'top'),
(2, '选购中心', 1, 2, 0, 'pick_out.php', 'top'),
(3, '查看购物车', 1, 0, 0, 'flow.php', 'top'),
(4, '团购商品', 1, 3, 0, 'group_buy.php', 'top'),
(5, '夺宝奇兵', 1, 4, 0, 'snatch.php', 'top'),
(6, '标签云', 1, 5, 6, 'tag_cloud.php', 'top'),

(7, '免责条款', 1, 1, 0, 'article.php?id=1', 'bottom'),
(8, '隐私保护', 1, 2, 0, 'article.php?id=2', 'bottom'),
(9, '咨询热点', 1, 3, 0, 'article.php?id=3', 'bottom'),
(10, '联系我们', 1, 4, 0, 'article.php?id=4', 'bottom'),
(11, '公司简介', 1, 5, 0, 'article.php?id=5', 'bottom'),
(12, '批发', 1, 6, 0, 'wholesale.php', 'bottom'),

(13, '优惠活动', 1, 7, 0, 'activity.php', 'top');

INSERT INTO `ecs_shop_config` VALUES (622, 6, 'sitemap', 'hidden', '', '', 'a:6:{s:19:"homepage_changefreq";s:6:"hourly";s:17:"homepage_priority";s:3:"0.9";s:19:"category_changefreq";s:6:"hourly";s:17:"category_priority";s:3:"0.8";s:18:"content_changefreq";s:6:"weekly";s:16:"content_priority";s:3:"0.7";}', 0);


-- 商品关注
DELETE FROM `ecs_mail_templates`  WHERE template_code = 'attention_list';
INSERT INTO `ecs_mail_templates` (`template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `type`) VALUES
('attention_list', 0, '关注商品', '亲爱的{$user_name}您好~\n\n您关注的商品 : {$goods_name} 最近已经更新,请您查看最新的商品信息\n\n{$goods_url}', 1183851073, 'template');

INSERT INTO `ecs_article` (`article_id`, `cat_id`, `title`, `content`, `author`, `author_email`, `keywords`, `article_type`, `is_open`, `add_time`, `file_url`, `open_type`) VALUES
(null, -1, '用户协议', '', '', '', '', 0, 1, 0, '', 0);

-- UPDATE `ecs_shop_config` SET value = '20' WHERE id='212';
UPDATE `ecs_shop_config` SET value = '30' WHERE id='325';
-- UPDATE `ecs_shop_config` SET value = '0' WHERE id='402';
DELETE FROM `ecs_shop_config` WHERE id in (308 , 309 , 310 , 311 , 322);

INSERT INTO `ecs_article` (`cat_id`, `title`, `content`, `author`, `author_email`, `keywords`, `article_type`, `is_open`, `add_time`, `file_url`, `open_type`) VALUES
(-1, '用户协议', '', '', '', '', 0, 1, 0, '', 0);

-- 积分规则设置
REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES(621, 6, 'points_rule', 'hidden', '', '', '', '');

-- 订单确认邮件模版改个变量
UPDATE `ecs_mail_templates` SET template_content = REPLACE( template_content, '{$order.order_time}', '{$order.formated_add_time}' ) WHERE template_code = 'order_confirm';

-- 增加管理导航栏权限
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (NULL, 5, 'navigator');