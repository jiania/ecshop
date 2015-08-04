-- 修改友情链接名称字段长度为 255
ALTER TABLE `ecs_friend_link` CHANGE `link_name` `link_name` VARCHAR( 255 ) NOT NULL;
