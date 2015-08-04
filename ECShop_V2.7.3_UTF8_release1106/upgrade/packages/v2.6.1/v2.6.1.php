<?php

/**
 * ECSHOP v2.6.1 升级程序
 * ============================================================================
 * 版权所有 (C) 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * @author:     ECSHOP R&D TEAM  http://www.ecshop.com
 * @version:    v2.x
 * ---------------------------------------------
 * $Author: liubo $
 * $Date: 2011-01-19 14:29:08 +0800 (星期三, 2011-01-19) $
 * $Id: v2.6.1.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_6_1
{
    var $sql_files = array(
                            'structure' => 'structure.sql',
                            'data' => array(
                                            'zh_cn_gbk' => 'data_zh_cn_gbk.sql',
                                            'zh_cn_utf-8' => 'data_zh_cn_utf-8.sql',
                                            'zh_tw_utf-8' => 'data_zh_tw_utf-8.sql'
                            )
        );

    var $auto_match = true;

    function __construct(){}
    function up_v2_6_1(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');

        /* 增加商店配置信息 */
        $sql_shop_config[1]['shop_reg_closed'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 1, 'shop_reg_closed', 'select', '1,0', '', '0', '1')";
        $sql_shop_config[2]['auto_generate_gallery'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'auto_generate_gallery', 'select', '1,0', '', '1', '1')";
        $sql_shop_config[2]['retain_original_img'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'retain_original_img', 'select', '1,0', '', '1', '1')";
        $sql_shop_config[2]['member_email_validate'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'member_email_validate', 'select', '1,0', '', '1', '1')";
        $sql_shop_config[2]['message_board'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'message_board', 'select', '1,0', '', '1', '1')";
        $sql_shop_config[3]['article_page_size'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 3, 'article_page_size', 'text', '', '', '10', '1')";
        $sql_shop_config[3]['recommend_order'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 3, 'recommend_order', 'select', '1,0', '', '0', '1')";
        $sql_shop_config[3]['page_style'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 3, 'page_style', 'select', '0,1', '', '0', '1')";
        $sql_shop_config[4]['send_service_email'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 4, 'send_service_email', 'select', '1,0', '', '0', '1')";
        $sql_shop_config[4]['show_goods_in_cart'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 4, 'show_goods_in_cart', 'select', '1,2,3', '', '1', '1')";
        $sql_shop_config[4]['show_attr_in_cart'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 4, 'show_attr_in_cart', 'select', '1,0', '', '0', '1')";
        $sql_shop_config[6]['flash_theme'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 6, 'flash_theme', 'hidden', '', '', 'default', '1')";

        foreach ($sql_shop_config as $key => $value)
        {
            /* 找出对应的父分类下的最大的id */
            $max_id = $db->getOne("SELECT MAX(id) + 1 FROM " . $ecs->table('shop_config') . " WHERE parent_id = '{$key}'");
            if (empty($max_id))
            {
                $max_id = 1;
            }
            for (;;)
            {
                $result = $db->getOne("SELECT code FROM " . $ecs->table('shop_config') . " WHERE id = '{$max_id}'");
                if (empty($result))
                {
                    break;
                }
                $max_id++;
            }
            foreach ($value as $code => $sql)
            {
                $code_exist = $db->getRow("SELECT code FROM " . $ecs->table('shop_config') . " WHERE code = '{$code}'");
                if (!$code_exist)
                {
                    $sql = str_replace('NULL', "$max_id", $sql);
                    $db->query($sql, 'SILENT');
                    $max_id++;
                }
            }
        }

        /* 修改商店设置 */

    }

    function update_files()
    {
        /* 修改Flash Data文件*/
        if (file_exists(ROOT_PATH . 'data/cycle_image.xml'))
        {
            preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"/', file_get_contents(ROOT_PATH . 'data/cycle_image.xml'), $t, PREG_SET_ORDER);
            if (!empty($t))
            {
                $xml = '<?xml version="1.0" encoding="' . EC_CHARSET . '"?><bcaster>';
                foreach ($t as $key => $val)
                {
                    $xml .= '<item item_url="' . $val[1] . '" link="' . $val[2] . '" text="" />';
                }
                $xml .= '</bcaster>';
            }
            file_put_contents(ROOT_PATH . 'data/flash_data.xml', $xml);
            @unlink(ROOT_PATH . 'data/cycle_image.xml');
        }
    }

    /**
     * 私有函数，转换时间的操作都放在这个函数里面
     *
     * @return  void
     */
    function convert_datetime()
    {


    }
}

?>
