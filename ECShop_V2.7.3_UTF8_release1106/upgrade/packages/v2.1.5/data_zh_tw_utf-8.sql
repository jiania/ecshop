-- 增加訂單編輯權限和查看已完成訂單權限
INSERT INTO `ecs_admin_action` ( `action_id` , `parent_id` , `action_code` )
VALUES (
NULL , '6', 'order_edit'
), (
NULL , '6', 'order_view_finished'
);

-- 用戶中心歡迎頁面公告
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'120', '1', 'user_notice', 'textarea', '', '', '用戶中心公告！'
);

-- 找回密碼的郵件模板
UPDATE `ecs_mail_templates` SET `template_content` = '{$user_name}您好！ \n您已經進行了找回密碼的操作，請點擊以下鏈接(或者複製到您的瀏覽器): \n{$reset_email} \n以確認您的新密碼重置操作！ \n{$shop_name} \n{$send_date} ' WHERE `ecs_mail_templates`.`template_id` =1 LIMIT 1 ;

-- 商店設置增加是否顯示市場價格的選項
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
UPDATE `ecs_mail_templates` SET `is_html` = '0', `template_content` = '親愛的{$consignee}。您好！\n您於{$order_time}在本店參加團購商品活動，所購買的商品名稱為：{$goods_name}，數量：{$goods_number}，訂單號為：{$order_sn}，訂單金額為：{$order_amount} \n此團購商品現在已到結束日期，並達到最低價格，您現在可以對該訂單付款。請點擊下麵的鏈結：\n{$shop_url} 請儘快登錄到用戶中心，查看您的訂單詳情資訊。\n\n{$shop_name} \n{$send_date}' WHERE `ecs_mail_templates`.`template_id` =7 LIMIT 1 ;