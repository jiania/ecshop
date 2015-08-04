--标签管理的权限code

INSERT INTO `ecs_admin_action` ( `action_id` , `parent_id` , `action_code`)
VALUES (
NULL , '1', 'tag_manage'
);


--增加网站默认宣传图片的设置选项
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'117', '1', 'shop_slagon', 'file', '', '../images/', ''
);

INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'323', '3', 'attr_related_number', 'text', '', '', '5'
);

UPDATE `ecs_shop_config` SET `store_dir` = '../themes/{$template}/images/' WHERE `code`='shop_logo' LIMIT 1 ;

--增加短信模块记录
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` ) VALUES
--用户名
('607', '6', 'sms_user_name', 'hidden', '', '', ''),
--MD5(密码)
('608', '6', 'sms_password', 'hidden', '', '', ''),	
--验证串
('609', '6', 'sms_auth_str', 'hidden', '', '', ''),	
--域名
('610', '6', 'sms_domain', 'hidden', '', '', ''),
--发送短信条数
('611', '6', 'sms_count', 'hidden', '', '', ''),
--总共充值多少钱
('612', '6', 'sms_total_money', 'hidden', '', '', ''),
--余额
('613', '6', 'sms_balance', 'hidden', '', '', ''),
--最后一次请求时间
('614', '6', 'sms_last_request', 'hidden', '', '', '');

--删除插件表中团购的记录
--DELETE FROM `ecs_plugins`  WHERE code='group_buy';

--增加短信设置
INSERT INTO `ecs_shop_config` VALUES
(8, 0, 'sms', 'group', '', '', ''),
(801, 8, 'sms_shop_mobile', 'text', '', '', ''),
(802, 8, 'sms_order_placed', 'select', '1,0', '', '1'),
(803, 8, 'sms_order_payed', 'select', '1,0', '', '0'),
(804, 8, 'sms_order_shipped', 'select', '1,0', '', '0');

--增加团购首页显示的数量设置
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'320', '3', 'group_goods_number', 'text', '', '', '3'
);
--增加商店关键字
UPDATE `ecs_shop_config`
SET `id` = `id` + 10001
WHERE `id` >103  AND `id` < 200;

UPDATE `ecs_shop_config`
SET `id` = `id` - 10000
WHERE `id` >10000;

INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'104', '1', 'shop_keywords', 'text', '', '', ''
);
--增加Skype 商品分类页排序类型 商品分类页排序方式
UPDATE `ecs_shop_config` SET `id` = '322' WHERE `id` =320 LIMIT 1 ;
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'320', '3', 'sort_order_type', 'select', '0,1,2', '', '0'
), (
'321', '3', 'sort_order_method', 'select', '0,1', '', '0'
);

UPDATE `ecs_shop_config` SET `id` = `id` +10001 WHERE `id` >110 AND `id` <200;
UPDATE `ecs_shop_config` SET `id` = `id` -10000 WHERE `id` >10000;
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'111', '1', 'skype', 'text', '', '', ''
);