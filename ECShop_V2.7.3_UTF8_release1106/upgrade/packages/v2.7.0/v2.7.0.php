<?php

/**
 * ECSHOP v2.7.0 升级程序
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
 * $Author: testyang $
 * $Date: 2008-11-12 15:38:08 +0800 (星期三, 12 十一月 2008) $
 * $Id: v2.6.1.php 15171 2008-11-12 07:38:08Z testyang $
 */

class up_v2_7_0
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
    function up_v2_7_0(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');

        //以下三个修改是替换空格分隔符为逗号分隔符
        $sql = "UPDATE " . $ecs->table('shop_config') . " SET value = REPLACE(value, ' ', ',') WHERE code = 'search_keywords'";
        $db->query($sql);

        $sql = "UPDATE " . $ecs->table('crons') . " SET minute = REPLACE(minute, ' ', ',') WHERE 1";
        $db->query($sql);

        $sql = "UPDATE " . $ecs->table('crons') . " SET allow_ip = REPLACE(allow_ip, ' ', ',') WHERE 1";
        $db->query($sql);
        /* 增加商店配置信息 */
        $sql_shop_config[2]['certificate_id'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'certificate_id', 'hidden', '', '', '', '1')";
        $sql_shop_config[2]['token'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'token', 'hidden', '', '', '', '1')";
        $sql_shop_config[2]['certi'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'certi', 'hidden', '', '', 'http://service.shopex.cn/openapi/api.php', '1')";
        $sql_shop_config[3]['index_ad'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 3, 'index_ad', 'hidden', '', '', 'sys', '1')";
        $sql_shop_config[6]['stylename'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 6, 'stylename', 'hidden', '', '', '', 1)";
        
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
    }

    function update_files()
    {
        global $ecs, $db, $prefix;

        //修改分类信息表中的筛选属性字段为text
        $db->query("ALTER TABLE " . $ecs->table('category') . " MODIFY `filter_attr` VARCHAR(255) NOT NULL DEFAULT '0'");

        //添加
        $db->query("ALTER TABLE " . $ecs->table('order_goods') . " ADD `goods_attr_id` VARCHAR(255) NOT NULL DEFAULT ''");
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
