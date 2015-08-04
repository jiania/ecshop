<?php

/**
 * ECSHOP v2.6.0 升级程序
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
 * $Id: v2.6.0.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_6_0
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
    function up_v2_6_0(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');

        $sql_shop_config['licensed'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES  (NULL, 1, 'licensed', 'select', '0,1', '', '1', '1')";
        $sql_shop_config['send_mail_on'] = "INSERT INTO " . $ecs->table('shop_config') . " (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, 2, 'send_mail_on', 'select', 'on,off', '', 'off', '1')";
        $sql_shop_config['integral_percent_del'] = "DELETE FROM " . $ecs->table('shop_config') . " WHERE `code`='integral_percent'";

        foreach ($sql_shop_config as $key => $sql)
        {
            /* 找出对应的父分类下的最大的id */
            if ($key == 'licensed')
            {
                $sql_id = " SELECT MAX(id) + 1 FROM " . $ecs->table('shop_config') . " WHERE parent_id =1";
                $id = $db->getOne($sql_id);
            }
            elseif ($key == 'send_mail_on')
            {
                $sql_id = " SELECT MAX(id) + 1 FROM " . $ecs->table('shop_config') . " WHERE parent_id =2";
                $id = $db->getOne($sql_id);
            }

            $sql_id_exists = " SELECT code FROM " . $ecs->table('shop_config') . " WHERE id ='$id' OR code = '$key'";
            $row = $db->getRow($sql_id_exists);

            if(isset($id) && !empty($id) && !$row)
            {
                $sql = str_replace('NULL', "$id", $sql);
            }

            $db->query($sql, 'SILENT');
        }

        /* 将会员的整合设置为ecshop */
        $sql = "UPDATE " .$ecs->table('shop_config'). " SET value = 'ecshop' WHERE code = 'integrate_code'";
        $db->query($sql);
        $sql = "UPDATE " . $GLOBALS['ecs']->table('shop_config') . " SET value = '' WHERE code = 'points_rule'";
        $GLOBALS['db']->query($sql);

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
