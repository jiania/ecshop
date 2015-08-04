<?php

/**
 * ECSHOP v2.5.1 升级程序
 * ============================================================================
 * 版权所有 (C) 2005-2011 北京亿商互动科技发展有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * @author:     ECSHOP R&D TEAM  http://www.ecshop.com
 * @version:    v2.x
 * ---------------------------------------------
 * $Author: liubo $
 * $Date: 2011-01-19 14:29:08 +0800 (星期三, 2011-01-19) $
 * $Id: v2.5.1.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_5_1
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
    function up_v2_5_1(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');

        $sql_shop_config['show_order_type'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 3, 'show_order_type', 'select', '0,1,2', '', '0', '1')";
        $sql_shop_config['help_open'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 3, 'help_open', 'select', '0,1', '', '1', '1')";

        foreach ($sql_shop_config as $key => $sql)
        {
            /* 找出对应的父分类下的最大的id */
            $sql_id = " SELECT MAX(id) + 1 FROM " . $ecs->table('shop_config') . " WHERE parent_id =3";
            $id = $db->getOne($sql_id);

            $sql_id_exists = " SELECT code FROM " . $ecs->table('shop_config') . " WHERE id ='$id' OR code = '$key'";
            $row = $db->getRow($sql_id_exists);

            if($id && !$row)
            {
                $sql = str_replace('NULL', "$id", $sql);
            }

            $db->query($sql, 'SILENT');
        }
    }

    function update_files()
    {
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
