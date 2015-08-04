<?php

/**
 * ECSHOP v2.1.0 升级程序
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Date: 2011-01-19 14:29:08 +0800 (星期三, 2011-01-19) $
 * $Id: v2.1.0.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_1_0
{
    /**
     * 本升级包中SQL文件存放的位置（相对于升级包所在的路径）。每个版本类必须有该属性。
     */
    var $sql_files = array(
                            'structure' => 'structure.sql',
                            'data' => array(
                                            'zh_cn_gbk' => 'data_zh_cn_gbk.sql',
                                            'zh_cn_utf-8' => 'data_zh_cn_utf-8.sql',
                                            'zh_tw_utf-8' => 'data_zh_tw_utf-8.sql'
                            )
        );
    
   /**
     * 本升级包是否进行智能化的查询操作。每个版本类必须有该属性。
     */
    var $auto_match = true;

    function __construct(){}
    function up_v2_1_0(){}

    /**
     * 提供给控制器的 接口 函数。每个版本类必须有该函数。
     */
    function update_database_optionally()
    {
        global $db, $ecs;

        if ($db->query("SELECT img_original FROM ".$ecs->table('goods_gallery'), 'SILENT') === false)
        {
            $db->query('ALTER TABLE '.$ecs->table('goods_gallery'). ' ADD img_original VARCHAR(255) NOT NULL');
        }

        if ($db->getOne('SELECT COUNT(*) FROM '.$ecs->table('shop_config')." WHERE code='article_number'") == 0)
        {
            $db->query("INSERT INTO ".$ecs->table('shop_config')." ( `id` , `parent_id` , `code` , `type` , `value` ) VALUES ('316', '3', 'article_number', 'text',  '4')");
        }
        
        $integral_percent = $db->getOne('SELECT value FROM ' . $ecs->table('shop_config') . " WHERE code='integral_percent'");
        $db->query("UPDATE " . $ecs->table("goods") . " SET integral = shop_price * " . intval($integral_percent)/100);   
    }
    
    /**
     * 提供给控制器的 接口 函数。每个版本类必须有该函数。
     */
    function update_files()
    {
        $result = file_mode_info(ROOT_PATH . 'data/');

        if ($result < 2)
        {
            die('ERROR, ' . ROOT_PATH . 'data/ isn\'t a writeable directory.');
        }

        if (!file_exists(ROOT_PATH . 'data/config.php'))
        {
            if (file_exists(ROOT_PATH . 'includes/config.php'))
            {            
                copy(ROOT_PATH . 'includes/config.php', ROOT_PATH . 'data/config.php');
                //unlink(ROOT_PATH . 'includes/config.php');
            }
            else
            {
                die("ERROR, can't find config.php.");
            }
        }

        if (!file_exists(ROOT_PATH . 'data/install.lock'))
        {
            if (file_exists(ROOT_PATH . 'includes/install.lock'))
            {
                copy(ROOT_PATH . 'includes/install.lock', ROOT_PATH . 'data/install.lock');
                //unlink(ROOT_PATH . 'includes/install.lock');
            }
            else
            {
                die("ERROR, can't find install.lock.");
            }
        }
    }
}

?>