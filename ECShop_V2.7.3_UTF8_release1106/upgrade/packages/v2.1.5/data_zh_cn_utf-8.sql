-- 增加订单编辑权限和查看已完成订单权限
INSERT INTO `ecs_admin_action` ( `action_id` , `parent_id` , `action_code` )
VALUES (
NULL , '6', 'order_edit'
), (
NULL , '6', 'order_view_finished'
);

-- 用户中心欢迎页面公告
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'120', '1', 'user_notice', 'textarea', '', '', '用户中心公告！'
);

-- 找回密码的邮件模板
UPDATE `ecs_mail_templates` SET `template_content` = '{$user_name}您好！ \n您已经进行了找回密码的操作，请点击以下链接(或者复制到您的浏览器):\n{$reset_email} \n以确认您的新密码重置操作！ \n{$shop_name}\n{$send_date} ' WHERE `ecs_mail_templates`.`template_id` =1 LIMIT 1 ;

-- 商店设置增加是否显示市场价格的选项
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'707', '7', 'show_marketprice', 'select', '1,0', '', '1'
);

-- 补充2个权限
INSERT INTO `ecs_admin_action` ( `action_id` , `parent_id` , `action_code` )
VALUES (
NULL , '1', 'tag_manage'
);

INSERT INTO `ecs_admin_action` ( `action_id` , `parent_id` , `action_code` )
VALUES (
NULL , '3', 'surplus_manage'
);

-- 团购商品邮件模板
UPDATE `ecs_mail_templates` SET `is_html` = '0', `template_content` = '亲爱的{$consignee}。您好！\n您于{$order_time}在本店参加团购商品活动，所购买的商品名称为：{$goods_name}，数量：{$goods_number}，订单号为：{$order_sn}，订单金额为：{$order_amount} \n此团购商品现在已到结束日期，并达到最低价格，您现在可以对该订单付款。请点击下面的链接：\n{$shop_url} 请尽快登录到用户中心，查看您的订单详情信息。\n\n{$shop_name} \n{$send_date}' WHERE `ecs_mail_templates`.`template_id` =7 LIMIT 1 ;