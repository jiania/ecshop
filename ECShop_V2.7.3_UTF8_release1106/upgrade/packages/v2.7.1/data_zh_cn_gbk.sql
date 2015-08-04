-- 把旧系统中已有的会员注册项标号ID全部后移100
UPDATE `ecs_reg_fields` AS rf SET rf.id = rf.id + 100;
UPDATE `ecs_reg_extend_info` AS re SET re.reg_field_id = re.reg_field_id + 100;
-- 添加系统保留的会员注册项信息
INSERT INTO `ecs_reg_fields` (`id`, `reg_field_name`, `dis_order`, `display`, `type`, `is_need`) VALUES (1, 'MSN', 0, 1, 1, 1), (2, 'QQ', 0, 1, 1, 1), (3, '办公电话', 0, 1, 1, 1), (4, '家庭电话', 0, 1, 1, 1), (5, '手机', 0, 1, 1, 1), (6, '密码找回问题', 0, 1, 1, 1);
INSERT INTO `ecs_admin_action` (`action_id`, `parent_id`, `action_code`) VALUES (135, 4, 'role_manage');