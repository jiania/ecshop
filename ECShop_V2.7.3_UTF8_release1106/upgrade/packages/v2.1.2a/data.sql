-- 增加排行统计时间的选项设置
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'222', '2', 'top10_time', 'select', '0,1,2,3,4', '', '0'
);

-- 增加商品详情页商品图片数量设置的选项
INSERT INTO `ecs_shop_config` ( `id` , `parent_id` , `code` , `type` , `store_range` , `store_dir` , `value` )
VALUES (
'324', '3', 'goods_gallery_number', 'text', '', '', '5'
);

-- 修改logo路径
UPDATE `ecs_shop_config` SET `store_dir` = '../themes/{$template}/images/' WHERE code = 'shop_logo';