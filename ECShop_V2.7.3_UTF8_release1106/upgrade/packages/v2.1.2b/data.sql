--增加文章标题的长度设置
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'325', '3', 'article_title_length', 'text', '', '', '30'
);

-- 修改图片存储路径
UPDATE `ecs_shop_config` SET `store_dir` = '../themes/{$template}/images/' WHERE code = 'shop_logo';
UPDATE `ecs_shop_config` SET `store_dir` = '../images/' WHERE code = 'watermark';
UPDATE `ecs_shop_config` SET `store_dir` = '../images/' WHERE code = 'no_picture';