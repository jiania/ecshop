<?php

/**
 * ECSHOP v2.1.2 升级程序
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Date: 2011-01-19 14:29:08 +0800 (星期三, 2011-01-19) $
 * $Id: v2.1.2.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_1_2
{
    var $sql_files = array('structure' => 'structure.sql',
                           'data' => 'data.sql');

    var $auto_match = true;

    function __construct(){}
    function up_v2_1_2(){}

    function update_database_optionally()
    {
        include_once(ROOT_PATH . 'includes/lib_code.php');
        global $ecs, $db, $prefix;
        
        $lang = $db->getOne("SELECT value FROM ". $ecs->table('shop_config'). " WHERE code = 'lang'");

        if ($db->getOne('SELECT COUNT(*) FROM ' . $ecs->table('plugins') . " WHERE `code` = 'group_buy'") > 0);
        {
            $db->query('DELETE FROM ' . $ecs->table('plugins') . " WHERE `code` = 'group_buy'");
        }
        
        $tables = $db->getCol('SHOW TABLES');
        $virtual_card = $ecs->table('virtual_card');
        $virtual_card = preg_replace('/`.*?`\.`(.*?)`/', '\1', $virtual_card);
        if (in_array($virtual_card, $tables))
        {
            $cols = $db->getCol("SHOW FIELDS FROM $virtual_card");
            if(in_array('crc32', $cols))
            {
                $sql = 'ALTER TABLE ' . $ecs->table('virtual_card') ." CHANGE `crc32` `crc32` INT NOT NULL DEFAULT '0'";
            }
            else
            {
                $sql = 'ALTER TABLE ' . $ecs->table('virtual_card') ." ADD `crc32` INT NOT NULL DEFAULT '0'";            
            }
            $db->query($sql);
            $sql = "UPDATE " . $ecs->table('virtual_card') . " SET `crc32` = '" . crc32(AUTH_KEY) . "'";
            $db->query($sql);
        }

        if ($db->getOne('SELECT COUNT(*) FROM '.$ecs->table('mail_templates')." WHERE template_code='group_buy'") == 0)
        {
            if (strtoupper($lang) == 'ZH_CN')
            {
                $sql = "INSERT INTO ". $ecs->table('mail_templates') . " (`template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`) VALUES ('group_buy', 1, '团购商品', '亲爱的{\$consignee}。您好！\n\n您于{\$order_time}在本店参加团购商品活动，所购买的商品名称为：{\$goods_name}，数量：{\$goods_number}，订单号为：{\$order_sn}，订单金额为：{\$order_amount}\n\n此团购商品现在已到结束日期，并达到最低价格，您现在可以对该订单付款。\n\n请点击下面的链接：\n\n<a href={\$shop_url} target=_blank>{\$shop_url}</a>\n\n请尽快登录到用户中心，查看您的订单详情信息。 \n\n{\$shop_name}\n\n{\$send_date}',1162201031)";
            }
            elseif (strtoupper($lang) == 'ZH_TW')
            {
                $sql = "INSERT INTO ". $ecs->table('mail_templates') . " (`template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`) VALUES ('group_buy', 1, '團購商品', '親愛的{\$consignee}。您好！\n\n您於{\$order_time}在本店參加團購商品活動，所購買的商品名稱為：{\$goods_name}，數量：{\$goods_number}，訂單號為：{\$order_sn}，訂單金額為：{\$order_amount}\n\n此團購商品現在已到結束日期，並達到最低價格，您現在可以對該訂單付款。\n\n請點擊下面的鏈接：\n\n<a href={\$shop_url} target=_blank>{\$shop_url}</a>\n\n請盡快登錄到用戶中心，查看您的訂單詳情信息。 \n\n{\$shop_name}\n\n{\$send_date}',1162201031)";
            }
            else
            {
                die('ERROR_WRONG_LANGUAGE');
            }

            $db->query($sql);
        }
    }

    function update_files(){}
}

?>