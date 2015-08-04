<?php

/**
 * ECSHOP v2.7.1 升级程序
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

class up_v2_7_1
{
    var $sql_files = array(
                            'structure' => 'structure.sql',
                            'data' => array(
                                            'zh_cn_gbk' => 'data_zh_cn_gbk.sql',
                                            'zh_cn_utf-8' => 'data_zh_cn_utf-8.sql',
                                            'zh_tw_utf-8' => 'data_zh_tw_utf-8.sql',
                                            'en_us_utf-8' => 'data_en_us_utf-8.sql'
                            )
        );

    var $auto_match = true;

    function __construct(){}
    function up_v2_7_1(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');

        // ecs_admin_action表，增加供货商操作控制
        $sql = "INSERT INTO " . $ecs->table('admin_action') . " (action_id, parent_id, action_code) VALUES (LAST_INSERT_ID(), 4, 'suppliers_manage')";
        $db->query($sql);
        unset($sql);

        // 将表中排序字段值加100
        $sql = "UPDATE " . $ecs->table('goods') . " SET sort_order = sort_order + 100";
        $db->query($sql, 'SILENT');

        $table_list = array('category', 'brand', 'favourable_activity', 'article_cat');
        foreach ($table_list as $value)
        {
            $sql = "UPDATE " . $ecs->table($value) . " SET sort_order = sort_order + 50";
            $db->query($sql, 'SILENT');
        }
        $sql = "UPDATE " . $ecs->table('friend_link') . " SET show_order = show_order + 50";
        $db->query($sql, 'SILENT');
        unset($sql, $table_list);
    }

    function update_files()
    {
        global $ecs, $db, $prefix;

        /* 修改/data/confing.php文件,增加自定义后台路径常量*/
        if (file_exists(ROOT_PATH . 'data/config.php'))
        {
            $conf_str = file_get_contents(ROOT_PATH . 'data/config.php');
            if (!strpos($conf_str, 'ADMIN_PATH'))
            {
                $insert_pos = strpos($conf_str, '?>');
                $back_str = substr($conf_str, 0, $insert_pos) . "define('ADMIN_PATH','admin');\n\n" . '?>';
                file_put_contents(ROOT_PATH . 'data/config.php', $back_str);
            }
        }

        /* 修改/data/confing.php文件,增加加密串常量 */
        if (file_exists(ROOT_PATH . 'data/config.php'))
        {
            $conf_str = file_get_contents(ROOT_PATH . 'data/config.php');
            if (!strpos($conf_str, 'AUTH_KEY'))
            {
                $insert_pos = strpos($conf_str, '?>');
                $back_str = substr($conf_str, 0, $insert_pos) . "define('AUTH_KEY', 'this is a key');\n\n" . '?>';
                file_put_contents(ROOT_PATH . 'data/config.php', $back_str);
            }
        }
        if (file_exists(ROOT_PATH . 'data/config.php'))
        {
            $conf_str = file_get_contents(ROOT_PATH . 'data/config.php');
            if (!strpos($conf_str, 'OLD_AUTH_KEY'))
            {
                $insert_pos = strpos($conf_str, '?>');
                $back_str = substr($conf_str, 0, $insert_pos) . "define('OLD_AUTH_KEY', '');\n\n" . '?>';
                file_put_contents(ROOT_PATH . 'data/config.php', $back_str);
            }
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
