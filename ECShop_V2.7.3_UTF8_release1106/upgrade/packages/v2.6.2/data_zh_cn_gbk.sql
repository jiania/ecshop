-- 在管理员权限表中增加“超值礼包”模块
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (104, 7, 'package_manage');

-- 在管理员权限表中增加权限模块
-- 商品管理
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (105, 1, 'picture_batch');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (106, 1, 'goods_export');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (107, 1, 'goods_batch');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (108, 1, 'gen_goods_script');
-- 系统设置
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (109, 5, 'sitemap');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (110, 5, 'file_priv');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (111, 5, 'file_check');

-- 新增 “模板管理” “数据库管理” “短信管理”
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (9, 0, 'templates_manage');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (10, 0, 'db_manage');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (11, 0, 'sms_manage');

-- 模板管理
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (112, 9, 'template_select');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (113, 9, 'template_setup');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (114, 9, 'library_manage');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (115, 9, 'lang_edit');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (116, 9, 'backup_setting');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (117, 9, 'mail_template');
-- 数据库管理
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (118, 10, 'db_backup');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (119, 10, 'db_renew');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (120, 10, 'db_optimize');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (121, 10, 'sql_query');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (122, 10, 'convert');

-- 短信管理
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (123, 11, 'my_info');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (124, 11, 'sms_send');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (125, 11, 'sms_charge');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (126, 11, 'send_history');
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (127, 11, 'charge_history');

-- 删除重复的权限(模板管理、数据库备份、数据库修复)
DELETE FROM `ecs_admin_action` WHERE `action_id` IN (74 , 76 , 77 );

-- 在管理员权限表中增加“积分商城商品”模块
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (128, 7, 'exchange_goods');

-- 在自定义导航栏表中增加“积分商城”模块
INSERT INTO `ecs_nav` (`ctype`, `cid`, `name`, `ifshow`, `vieworder`, `opennew`, `url`, `type`) VALUES (NULL, NULL, '积分商城', 1, 24, 0, 'exchange.php', 'middle');
