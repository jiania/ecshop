<?php

/**
 * ECSHOP v2.1.5 升级程序
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
 * $Id: v2.1.5.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_1_5
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
    function up_v2_1_5(){}

    function update_database_optionally()
    {
        include_once(ROOT_PATH . 'includes/inc_constant.php');
        global $ecs, $db, $prefix;

        /* 把退款申请 repay 的数据导入帐户明细 user_account 表 */
        $sql = "INSERT INTO " . $ecs->table('user_account') . "(id, user_id, " .
                    "admin_user, amount, add_time, paid_time, admin_note, " .
                    "user_note, process_type, payment, is_paid) " .
               "SELECT rec_id, user_id, action_user, amount, apply_time, " .
                    "action_time, action_note, '', ". SURPLUS_RETURN . ", method, is_repayed " .
               "FROM " . $ecs->table('repay');
        $db->query($sql, 'SILENT');

        $sql = "DROP TABLE " . $ecs->table('repay');
        $db->query($sql, 'SILENT');

        /* 更新购物车中的商品属性 */
        $sql = "SELECT rec_id, goods_attr FROM "  . $ecs->table('cart') .
                " WHERE goods_attr <> ''";
        $goods_list = $db->getAll($sql);
        foreach ($goods_list as $goods)
        {
            /* 原属性 1,2,3 */
            $old_attr   = $goods['goods_attr'];
            $ga_id_list = explode(',', $old_attr); // goods_attr_id 列表

            /* 新属性列表 */
            $new_attr_list = array();
            foreach ($ga_id_list as $goods_attr_id)
            {
                $goods_attr_id = intval($goods_attr_id);
                $sql = "SELECT a.attr_name, ga.attr_value, ga.attr_price " .
                        "FROM " . $ecs->table('goods_attr') . " AS ga, " .
                            $ecs->table('attribute') . " AS a " .
                        "WHERE ga.attr_id = a.attr_id " .
                        "AND ga.goods_attr_id = '$goods_attr_id'";
                $attr = $db->getRow($sql);
                if (!empty($attr))
                {
                    $new_attr = $attr['attr_name'] . ': ' . $attr['attr_value'];
                    $attr_price = floatval($attr['attr_price']);
                    if ($attr_price > 0)
                    {
                        $new_attr .= ' [+' . $attr_price . ']';
                    }
                    elseif ($attr_price < 0)
                    {
                        $new_attr .= ' [-' . abs($attr_price) . ']';
                    }

                    $new_attr_list[] = $new_attr;
                }
            }

            /* 更新新属性 */
            $new_attr = join(chr(13) . chr(10), $new_attr_list);
            $sql = "UPDATE " . $ecs->table('cart') .
                    " SET goods_attr = '$new_attr' " .
                    " WHERE rec_id = '$goods[rec_id]'" .
                    " LIMIT 1";
            $db->query($sql, 'SILENT');
        }

        /* 更新订单商品中的商品属性 */
        $sql = "SELECT rec_id, goods_attr FROM "  . $ecs->table('order_goods') .
                " WHERE goods_attr <> ''";
        $goods_list = $db->getAll($sql);
        foreach ($goods_list as $goods)
        {
            /* 原属性 1,2,3 */
            $old_attr   = $goods['goods_attr'];
            $ga_id_list = explode(',', $old_attr); // goods_attr_id 列表

            /* 新属性列表 */
            $new_attr_list = array();
            foreach ($ga_id_list as $goods_attr_id)
            {
                $goods_attr_id = intval($goods_attr_id);
                $sql = "SELECT a.attr_name, ga.attr_value, ga.attr_price " .
                        "FROM " . $ecs->table('goods_attr') . " AS ga, " .
                            $ecs->table('attribute') . " AS a " .
                        "WHERE ga.attr_id = a.attr_id " .
                        "AND ga.goods_attr_id = '$goods_attr_id'";
                $attr = $db->getRow($sql);
                if (!empty($attr))
                {
                    $new_attr = $attr['attr_name'] . ': ' . $attr['attr_value'];
                    $attr_price = floatval($attr['attr_price']);
                    if ($attr_price > 0)
                    {
                        $new_attr .= ' [+' . $attr_price . ']';
                    }
                    elseif ($attr_price < 0)
                    {
                        $new_attr .= ' [-' . abs($attr_price) . ']';
                    }

                    $new_attr_list[] = $new_attr;
                }
            }

            /* 更新新属性 */
            $new_attr = join(chr(13) . chr(10), $new_attr_list);
            $sql = "UPDATE " . $ecs->table('order_goods') .
                    " SET goods_attr = '$new_attr' " .
                    " WHERE rec_id = '$goods[rec_id]'" .
                    " LIMIT 1";
            $db->query($sql, 'SILENT');
        }

        /* 如果原来的订单状态为已确认、已付款，修改 money_paid = order_amount, order_amount = 0 */
        $sql = "UPDATE " . $ecs->table('order_info') .
                " SET money_paid = order_amount, order_amount = 0 " .
                "WHERE order_status = '" . OS_CONFIRMED . "' " .
                "AND pay_status > '" . PS_UNPAYED . "'";
        $db->query($sql, 'SILENT');

        /* 如果原来的订单状态为取消、无效或退货，修改红包、积分、余额为0，付款状态为未付款，发货状态为未发货 */
        $sql = "UPDATE " . $ecs->table('order_info') .
                " SET bonus_id = 0, bonus = 0, integral = 0, integral_money = 0, surplus = 0, " .
                    "pay_status = '" . PS_UNPAYED . "', shipping_status = '" . SS_UNSHIPPED . "', " .
                    "order_amount = goods_amount + shipping_fee + pack_fee + card_fee " .
                "WHERE order_status = '" . OS_CANCELED . "' " .
                "OR order_status = '" . OS_INVALID . "' " .
                "OR order_status = '" . OS_RETURNED . "'";
        $db->query($sql, 'SILENT');

        /* 修正之前的时间代码拼写错误 */
        $sql = "UPDATE " . $ecs->table('shop_config') .
                " SET value = 'Y-m-d H:i:s'" .
                " WHERE code = 'time_format' AND value = 'Y-m-d H:m:s'";
        $db->query($sql, 'SILENT');

        /**
         * 初始化帐户明细
         */

        /* 查询用户余额 */
        $user_money = array();
        $sql = "SELECT user_id, user_money FROM " . $ecs->table('users');
        $res = $db->query($sql);
        while ($money = $db->fetchRow($res))
        {
            $user_money[$money['user_id']] = $money['user_money'];
        }

        /* 查询帐户明细余额 */
        $user_account = array();
        $sql = "SELECT user_id, SUM(amount) AS amount" .
                " FROM " . $ecs->table('user_account') .
                " WHERE is_paid = 1" .
                " GROUP BY user_id";
        $res = $db->query($sql);
        while ($account = $db->fetchRow($res))
        {
            $user_account[$account['user_id']] = $account['amount'];
        }

        $time = 1167580799; // 2006 年最后一秒

        /* 如果对不上，插入一条记录 */
        foreach ($user_money as $user_id => $money)
        {
            $diff = $money - @$user_account[$user_id];
            if ($diff != 0)
            {
                $arr = array(
                    'user_id'       => $user_id,
                    'admin_user'    => 'upgrade',
                    'amount'        => $diff,
                    'add_time'      => $time,
                    'paid_time'     => $time,
                    'admin_note'    => 'initialize account',
                    'user_note'     => '',
                    'process_type'  => $diff > 0 ? SURPLUS_SAVE : SURPLUS_RETURN,
                    'is_paid'       => 1
                );
                $db->autoExecute($ecs->table('user_account'), $arr, 'INSERT');
            }
        }
    }

    function update_files()
    {
        $config_path = ROOT_PATH . 'data/config.php';

        @chmod($config_path, 0777);
        if (file_mode_info($config_path) < 7)
        {
            die('Config file isn\'t writable!');
        }
        else
        {
            $ori_content = implode('', file($config_path));

            $fp = @fopen($config_path, 'wb+');
            if (!$fp)
            {
                die('Open config file failed!');
            }

            $timezone = $this->get_local_timezone();
            $content = "\n\n\$timezone  = \"$timezone\";\n\n";
            $content .= "\$cookie_path = \"/\";\n\n";
            $content .= "\$cookie_domain = \"\";\n\n";
            $content .= "\$admin_dir = \"admin\";\n\n";
            $content .= "\$session   = \"1440\";\n";

            $new_content = preg_replace('/(\$prefix\s*=[^;]+;).*(\?\>)/is', '\1' . $content . "\r\n\r\n\\2",  $ori_content);
            if (!@fwrite($fp,  $new_content))
            {
                die('Write config file failed!');
            }
            @fclose($fp);
        }

        return  $this->handle_plugins();
    }

    function handle_plugins()
   {
        global $ecs, $db;

        $sql = "UPDATE " . $ecs->table('shop_config') . " SET `code` = 'article_number' WHERE `code` = 'article_number '";
        $db->query($sql);

        $GLOBALS['_CFG'] = load_config();
        $plugin_dir = ROOT_PATH . 'plugins/';

        if (!file_exists($plugin_dir))
        {
            die('can\'t fine plugins\' directory!');
        }

        $plugin_handle = @opendir($plugin_dir);
        while (($filename = @readdir($plugin_handle)) !== false)
        {
            $cls_path = $plugin_dir .  $filename . '/' . $filename . '_inc.php';
            if (file_exists($cls_path))
            {
                include_once($cls_path);
                /* 读出常规语言项 */
                if(file_exists($plugin_dir.$filename.'/languages/common_'.$GLOBALS['_CFG']['lang'].'.php'))
                {
                    include_once($plugin_dir.$filename.'/languages/common_'.$GLOBALS['_CFG']['lang'].'.php');
                }
                if (file_exists(ROOT_PATH . '/languages/'.$GLOBALS['_CFG']['lang'] .'/admin/plugins.php'))
                {
                    include_once(ROOT_PATH . '/languages/'.$GLOBALS['_CFG']['lang'] .'/admin/plugins.php');
                }
                $obj = new $filename();
                $version = $db->getOne("SELECT version FROM " . $ecs->table('plugins') . " WHERE code = '$filename'");
                $version = empty($version) ? '1.0' : $version;
                $obj->upgrade($version);

                if (!empty($obj->error))
                {
                    $err->add(array('type'=>'NOTICE', 'msg'=>$obj->error));

                    return false;
                }
            }
        }
        @closedir($plugin_handle);

        return true;
   }

    /**
     * 获得服务器所在时区
     *
     * @access  public
     * @return  string     返回时区串，形如+0800
     */
    function get_local_timezone()
    {
        if (PHP_VERSION >= '5.1')
        {
            $local_timezone = date_default_timezone_get();
        }
        else
        {
             $local_timezone = '';
        }

        return $local_timezone;
    }
}

?>