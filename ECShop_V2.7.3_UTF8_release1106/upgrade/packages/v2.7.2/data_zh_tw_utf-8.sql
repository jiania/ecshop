-- 添加三个邮件模板内容
INSERT INTO `ecs_mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `last_send`, `type`) VALUES
('', 'goods_booking', 1, '缺貨回復', '親愛的{$user_name}。你好！</br></br>您提交的缺貨商品為</br></br><a href="{$goods_link}" target="_blank">{$goods_name}</a></br><br>店家給您的回復：</br>{$dispose_note}</br></br>{$shop_name} </br>{$send_date}', 0, 0, 'template'),
('', 'user_message', 1, '留言回復', '親愛的{$user_name}。你好！</br></br>對您的留言：</br>{$message_content}</br></br>店主作了如下回復：</br>{$message_note}</br></br>您可以隨時回到店中和店主繼續溝通。</br>{$shop_name}</br>{$send_date}', 0, 0, 'template'),
('', 'recomment', 1, '用戶評論回復', '親愛的{$user_name}。你好！</br></br>對您的評論：</br>“{$comment}”</br></br>店主作了如下回復：</br>“{$recomment}”</br></br>您可以隨時回到店中和店主繼續溝通。</br>{$shop_name}</br>{$send_date}', 0, 0, 'template');

-- 添加调查选项的排序值
ALTER TABLE `ecs_vote_option` ADD `option_order` TINYINT UNSIGNED NOT NULL DEFAULT '100';
-- 添加权限关联
UPDATE `ecs_admin_action` SET `relevance` = 'cat_manage' WHERE `action_id` = '24';
UPDATE `ecs_admin_action` SET `relevance` = 'integrate_users' WHERE `action_id` = '39';
UPDATE `ecs_admin_action` SET `relevance` = 'users_manage' WHERE `action_id` = '41';
UPDATE `ecs_admin_action` SET `relevance` = 'account_manage' WHERE `action_id` = '85';
UPDATE `ecs_admin_action` SET `relevance` = 'admin_manage' WHERE `action_id` = '44';
UPDATE `ecs_admin_action` SET `relevance` = 'admin_manage' WHERE `action_id` = '45';
UPDATE `ecs_admin_action` SET `relevance` = 'logs_manage' WHERE `action_id` = '47';
UPDATE `ecs_admin_action` SET `relevance` = 'order_os_edit' WHERE `action_id` = '54';
UPDATE `ecs_admin_action` SET `relevance` = 'order_os_edit' WHERE `action_id` = '55';
UPDATE `ecs_admin_action` SET `relevance` = 'order_os_edit' WHERE `action_id` = '56';
UPDATE `ecs_admin_action` SET `relevance` = 'db_backup' WHERE `action_id` = '77';
