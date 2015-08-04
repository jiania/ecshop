UPDATE `ecs_article_cat` SET show_in_nav = 0;


REPLACE INTO `ecs_mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`) VALUES
(3, 'deliver_notice', 0, '发货通知', '亲爱的{$order.consignee}。你好！\n\n您的订单{$order.order_sn}已于{$send_time}按照您预定的配送方式给您发货了。\n\n{if $order.invoice_no}发货单号是{$order.invoice_no}。{/if}\n\n在您收到货物之后请点击下面的链接确认您已经收到货物：\n{$confirm_url}\n\n再次感谢您对我们的支持。欢迎您的再次光临。 \n\n{$shop_name}\n{$send_date}', 1162201031);


UPDATE `ecs_shop_config` SET id = id + 1000;
UPDATE `ecs_shop_config` SET id = 6 WHERE code = 'hidden';
REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES (7, 0, 'goods', 'group', '', '', '');
UPDATE `ecs_shop_config` SET id = 101 WHERE code =  'shop_name';
UPDATE `ecs_shop_config` SET id = 102 WHERE code =  'shop_title';
UPDATE `ecs_shop_config` SET id = 103 WHERE code = 'shop_desc';
UPDATE `ecs_shop_config` SET id = 104 WHERE code =  'shop_country';
UPDATE `ecs_shop_config` SET id = 105 WHERE code =  'shop_province';
UPDATE `ecs_shop_config` SET id = 106 WHERE code =  'shop_city';
UPDATE `ecs_shop_config` SET id = 107 WHERE code =  'shop_address';
UPDATE `ecs_shop_config` SET id = 108 WHERE code =  'qq';
UPDATE `ecs_shop_config` SET id = 109 WHERE code =  'ww';
UPDATE `ecs_shop_config` SET id = 110 WHERE code =  'ym';
UPDATE `ecs_shop_config` SET id = 111 WHERE code =  'msn';
UPDATE `ecs_shop_config` SET id = 112 WHERE code =  'service_email';
UPDATE `ecs_shop_config` SET id = 113 WHERE code =  'service_phone';
UPDATE `ecs_shop_config` SET id = 114 WHERE code =  'shop_closed';
UPDATE `ecs_shop_config` SET id = 115 WHERE code =  'close_comment';
REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES (116, 1, 'shop_logo', 'file', '', '../images/', '');
UPDATE `ecs_shop_config` SET id = 201 WHERE code = 'lang';
UPDATE `ecs_shop_config` SET id = 202 WHERE code =  'icp_number';
UPDATE `ecs_shop_config` SET id = 203 WHERE code =  'icp_file';
UPDATE `ecs_shop_config` SET id = 204 WHERE code =  'watermark';
UPDATE `ecs_shop_config` SET id = 205, store_range='0,1,2,3,4,5' WHERE code = 'watermark_place';
UPDATE `ecs_shop_config` SET id = 206 WHERE code =   'watermark_alpha';
UPDATE `ecs_shop_config` SET id = 207 WHERE code =  'use_storage';
UPDATE `ecs_shop_config` SET id = 208 WHERE code =  'market_price_rate';
UPDATE `ecs_shop_config` SET id = 209 WHERE code =  'rewrite';
UPDATE `ecs_shop_config` SET id = 210 WHERE code = 'integral_name';
UPDATE `ecs_shop_config` SET id = 211 WHERE code =  'integral_scale';
UPDATE `ecs_shop_config` SET id = 212 WHERE code =  'integral_percent';
UPDATE `ecs_shop_config` SET id = 213 WHERE code = 'sn_prefix';
UPDATE `ecs_shop_config` SET id = 214 WHERE code =  'comment_check';
REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES 
(215, 2, 'no_picture', 'file', '', '../images/', '../images/no_picture.gif'),
(216, 2, 'enable_captcha', 'select', '0,1', '', '0'),
(217, 2, 'comment_captcha', 'select', '0,1', '', '0'),
(218, 2, 'stats_code', 'textarea', '', '', ''),
(219, 2, 'cache_time', 'text', '', '', '3600'),
(220, 2, 'register_points', 'text', '', '', '0'),
(221, 2, 'enable_gzip', 'select', '0,1', '', '0');
UPDATE `ecs_shop_config` SET id = 301 WHERE code = 'date_format';
UPDATE `ecs_shop_config` SET id = 302 WHERE code = 'time_format';
UPDATE `ecs_shop_config` SET id = 303 WHERE code = 'currency_format';
UPDATE `ecs_shop_config` SET id = 304 WHERE code = 'thumb_width';
UPDATE `ecs_shop_config` SET id = 305 WHERE code = 'thumb_height';
UPDATE `ecs_shop_config` SET id = 306 WHERE code = 'image_width';
UPDATE `ecs_shop_config` SET id = 307 WHERE code = 'image_height';
UPDATE `ecs_shop_config` SET id = 308 WHERE code = 'best_number';
UPDATE `ecs_shop_config` SET id = 309 WHERE code = 'new_number';
UPDATE `ecs_shop_config` SET id = 310 WHERE code ='hot_number';
UPDATE `ecs_shop_config` SET id = 311 WHERE code = 'promote_number';
UPDATE `ecs_shop_config` SET id = 312 WHERE code = 'top_number';
UPDATE `ecs_shop_config` SET id = 313 WHERE code = 'history_number';
UPDATE `ecs_shop_config` SET id = 314 WHERE code = 'comments_number';
UPDATE `ecs_shop_config` SET id = 315 WHERE code = 'bought_goods';
UPDATE `ecs_shop_config` SET id = 316 WHERE code = 'article_number';

REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES
(317, 3, 'goods_name_length', 'text', '', '', '10'),
(318, 3, 'price_format', 'select', '0,1,2,3,4,5', '', '0');

UPDATE `ecs_shop_config` SET id = 401 WHERE code = 'can_invoice';
UPDATE `ecs_shop_config` SET id = 402 WHERE code = 'use_integral';
UPDATE `ecs_shop_config` SET id = 403 WHERE code = 'use_bonus';

REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES
(404, 4, 'use_surplus', 'select', '1,0', '', '1');

UPDATE `ecs_shop_config` SET id = 405 WHERE code = 'use_how_oos';
UPDATE `ecs_shop_config` SET id = 406 WHERE code = 'send_confirm_email';
UPDATE `ecs_shop_config` SET id = 407 WHERE code = 'send_ship_email';
UPDATE `ecs_shop_config` SET id = 408 WHERE code = 'send_cancel_email';
UPDATE `ecs_shop_config` SET id = 409 WHERE code =  'send_invalid_email';
UPDATE `ecs_shop_config` SET id = 410 WHERE code = 'order_pay_note';
UPDATE `ecs_shop_config` SET id = 411 WHERE code =  'order_unpay_note';
UPDATE `ecs_shop_config` SET id = 412 WHERE code = 'order_ship_note';
UPDATE `ecs_shop_config` SET id = 413 WHERE code = 'order_receive_note';
UPDATE `ecs_shop_config` SET id = 414 WHERE code =  'order_unship_note';
UPDATE `ecs_shop_config` SET id = 415 WHERE code =  'order_return_note';
UPDATE `ecs_shop_config` SET id = 416 WHERE code =  'order_invalid_note';
UPDATE `ecs_shop_config` SET id = 417 WHERE code =  'order_cancel_note';
UPDATE `ecs_shop_config` SET id = 418 WHERE code =  'invoice_content';

REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES
(419, 4, 'anonymous_buy', 'select', '1,0', '', '1');


UPDATE `ecs_shop_config` SET id = 501, parent_id = 5 WHERE code = 'smtp_host';
UPDATE `ecs_shop_config` SET id = 502, parent_id = 5 WHERE code = 'smtp_port';
UPDATE `ecs_shop_config` SET id = 503, parent_id = 5 WHERE code =  'smtp_user';
UPDATE `ecs_shop_config` SET id = 504, parent_id = 5 WHERE code =  'smtp_pass';
UPDATE `ecs_shop_config` SET id = 505, parent_id = 5 WHERE code =  'smtp_mail';
UPDATE `ecs_shop_config` SET id = 601, parent_id = 6 WHERE code =  'integrate_code';
UPDATE `ecs_shop_config` SET id = 602, parent_id = 6 WHERE code =  'integrate_config';
UPDATE `ecs_shop_config` SET id = 603, parent_id = 6 WHERE code =  'hash_code';
UPDATE `ecs_shop_config` SET id = 604, parent_id = 6 WHERE code =  'template';
UPDATE `ecs_shop_config` SET id = 605, parent_id = 6 WHERE code =  'install_date';

REPLACE INTO `ecs_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`) VALUES
(606, 6, 'ecs_version', 'hidden', '', '', ''),
(701, 7, 'show_goodssn', 'select', '1,0', '', '1'),
(702, 7, 'show_brand', 'select', '1,0', '', '1'),
(703, 7, 'show_goodsweight', 'select', '1,0', '', '1'),
(704, 7, 'show_goodsnumber', 'select', '1,0', '', '1'),
(705, 7, 'show_addtime', 'select', '1,0', '', '1'),
(706, 7, 'goodsattr_style', 'select', '1,0', '', '1');
UPDATE `ecs_shop_config` SET id = id - 1000 WHERE id > 1000;


UPDATE `ecs_template` SET region = '导航栏下方左侧' WHERE region = 'navigatorBottomLeft';
UPDATE `ecs_template` SET region = '导航栏下方右侧' WHERE region = 'navigatorBottomRight';
UPDATE `ecs_template` SET region = '主区域左侧' WHERE region = 'mainLeft';
UPDATE `ecs_template` SET region = '主区域右侧' WHERE region = 'mainRight';
UPDATE `ecs_template` SET region = '主区域中间部分' WHERE region = 'mainCenter';
UPDATE `ecs_template` SET region = '主区域顶部' WHERE region = 'mainTop';
INSERT INTO `ecs_template` (`filename`, `region`, `library`, `sort_order`, `id`, `number`, `type`) VALUES 
('receive', '导航栏下方左侧', '/library/ur_here.lbi', 0, 0, 5, 0),
('receive', '导航栏下方右侧', '/library/search_form.lbi', 0, 0, 5, 0),
('tag_cloud', '导航栏下方左侧', '/library/ur_here.lbi', 0, 0, 5, 0),
('tag_cloud', '导航栏下方右侧', '/library/search_form.lbi', 0, 0, 5, 0),
('tag_cloud', '主区域左侧', '/library/category_tree.lbi', 0, 0, 5, 0),
('tag_cloud', '主区域左侧', '/library/cart.lbi', 1, 0, 5, 0),
('tag_cloud', '主区域左侧', '/library/history.lbi', 2, 0, 5, 0),
('tag_cloud', '主区域右侧', '/library/tag_list.lbi', 0, 0, 5, 0),
('advanced_search', '导航栏下方左侧', '/library/ur_here.lbi', 0, 0, 5, 0),
('advanced_search', '导航栏下方右侧', '/library/search_form.lbi', 0, 0, 5, 0),
('advanced_search', '主区域左侧', '/library/cart.lbi', 0, 0, 5, 0),
('advanced_search', '主区域左侧', '/library/top10.lbi', 1, 0, 5, 0),
('advanced_search', '主区域左侧', '/library/history.lbi', 2, 0, 5, 0),
('advanced_search', '主区域中间部分', '/library/search_advanced.lbi', 0, 0, 5, 0),
('catalog', '导航栏下方左侧', '/library/ur_here.lbi', 0, 0, 5, 0),
('catalog', '导航栏下方右侧', '/library/search_form.lbi', 0, 0, 5, 0),
('pick_out', '导航栏下方左侧', '/library/ur_here.lbi', 0, 0, 5, 0),
('pick_out', '导航栏下方右侧', '/library/search_form.lbi', 0, 0, 5, 0),
('pick_out', '主区域左侧', '/library/pickout.lbi', 0, 0, 5, 0),
('pick_out', '主区域右侧部分', '/library/your_picking.lbi', 0, 0, 5, 0),
('pick_out', '主区域右侧部分', '/library/cart.lbi', 1, 0, 5, 0),
('pick_out', '主区域右侧部分', '/library/top10.lbi', 2, 0, 5, 0);