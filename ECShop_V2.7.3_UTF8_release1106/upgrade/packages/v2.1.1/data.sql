REPLACE INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
506, 5, 'mail_charset', 'select', 'UTF8,GB2312,BIG5', '', 'UTF8'
);


REPLACE INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
319, 3, 'page_size', 'text', '', '', '10'
);

UPDATE `ecs_shop_config` SET `store_range` = '0,1,2' WHERE `code` = 'rewrite' LIMIT 1;
UPDATE `ecs_shop_config` SET `store_dir` = '../images/', `value` = '../images/watermark.gif' WHERE `code` = 'watermark' LIMIT 1;
UPDATE `ecs_shop_config` SET `store_dir` = '../images/', `value` = '../images/no_picture.gif' WHERE `code` = 'no_picture' LIMIT 1;
UPDATE `ecs_shop_config` SET `value` = '../images/logo.gif' WHERE `code` ='shop_logo' LIMIT 1;