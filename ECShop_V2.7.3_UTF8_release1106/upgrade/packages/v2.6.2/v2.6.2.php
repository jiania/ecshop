<?php

/**
 * ECSHOP v2.6.2 升级程序
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

class up_v2_6_2
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
    function up_v2_6_2(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');
        /* 增加商店配置信息 */
        $sql_shop_config[2]['message_check'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'message_check', 'select', '1,0', '', '1', '1')";
        $sql_shop_config[5]['smtp_ssl'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL , 5, 'smtp_ssl', 'select', '0,1', '', '0', '1')";
        
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
        //查询sort_order字段是否存在
        $sort_order_col = $db->getRow("DESCRIBE " . $ecs->table('goods') . " `sort_order`");
        if (!$sort_order_col)
        {
            $db->query("ALTER TABLE " . $ecs->table('goods') . " ADD `sort_order` MEDIUMINT( 4 ) NOT NULL DEFAULT '0'");
        }
        $db->query("ALTER TABLE " . $ecs->table('goods') . " ADD INDEX (`sort_order`)");
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
