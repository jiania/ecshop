<?php

/**
 * ECSHOP v2.7.2 升级程序
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

class up_v2_7_2
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
    function up_v2_7_2(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');

        /* 新增快递单打印模式 */
        $sql = 'SELECT shipping_code FROM ' . $ecs->table('shipping');
        $res_shipping_code = $db->getAll($sql);
        if (!empty($res_shipping_code))
        {
            foreach ($res_shipping_code as $value)
            {
                $sql = '';
                switch ($value)
                {
                    case 'yto':
                        $sql = "UPDATE " . $ecs->table('shipping') . "
                                SET print_bg = '/images/receipt/dly_yto.jpg', config_lable = 't_shop_province,网店-省份,132,24,279.6,105.7,b_shop_province||,||t_shop_name,网店-名称,268,29,142.95,133.85,b_shop_name||,||t_shop_address,网店-地址,346,40,67.3,199.95,b_shop_address||,||t_shop_city,网店-城市,64,35,223.8,163.95,b_shop_city||,||t_shop_district,网店-区/县,56,35,314.9,164.25,b_shop_district||,||t_pigeon,√-对号,21,21,143.1,263.2,b_pigeon||,||t_customer_name,收件人-姓名,89,25,488.65,121.05,b_customer_name||,||t_customer_tel,收件人-电话,136,21,656,110.6,b_customer_tel||,||t_customer_mobel,收件人-手机,137,21,655.6,132.8,b_customer_mobel||,||t_customer_province,收件人-省份,115,24,480.2,173.5,b_customer_province||,||t_customer_city,收件人-城市,60,27,609.3,172.5,b_customer_city||,||t_customer_district,收件人-区/县,58,28,696.8,173.25,b_customer_district||,||t_customer_post,收件人-邮编,93,21,701.1,240.25,b_customer_post||,||'
                                WHERE shipping_code = 'yto'";
                        $db->query($sql);
                    break;

                    case 'sto_express':
                        $sql = "UPDATE " . $ecs->table('shipping') . "
                                SET print_bg = '/images/receipt/dly_sto_express.jpg', config_lable = 't_shop_address,网店-地址,235,48,131,152,b_shop_address||,||t_shop_name,网店-名称,237,26,131,200,b_shop_name||,||t_shop_tel,网店-联系电话,96,36,144,257,b_shop_tel||,||t_customer_post,收件人-邮编,86,23,578,268,b_customer_post||,||t_customer_address,收件人-详细地址,232,49,434,149,b_customer_address||,||t_customer_name,收件人-姓名,151,27,449,231,b_customer_name||,||t_customer_tel,收件人-电话,90,32,452,261,b_customer_tel||,||'
                                WHERE shipping_code = 'sto_express'";
                        $db->query($sql);
                    break;

                    case 'ems':
                        $sql = "UPDATE " . $ecs->table('shipping') . "
                                SET print_bg = '/images/receipt/dly_ems.jpg', config_lable = 't_shop_name,网店-名称,236,32,182,161,b_shop_name||,||t_shop_tel,网店-联系电话,127,21,295,135,b_shop_tel||,||t_shop_address,网店-地址,296,68,124,190,b_shop_address||,||t_pigeon,√-对号,21,21,192,278,b_pigeon||,||t_customer_name,收件人-姓名,107,23,494,136,b_customer_name||,||t_customer_tel,收件人-电话,155,21,639,124,b_customer_tel||,||t_customer_mobel,收件人-手机,159,21,639,147,b_customer_mobel||,||t_customer_post,收件人-邮编,88,21,680,258,b_customer_post||,||t_year,年-当日日期,37,21,534,379,b_year||,||t_months,月-当日日期,29,21,592,379,b_months||,||t_day,日-当日日期,27,21,642,380,b_day||,||t_order_best_time,送货时间-订单,104,39,688,359,b_order_best_time||,||t_order_postscript,备注-订单,305,34,485,402,b_order_postscript||,||t_customer_address,收件人-详细地址,289,48,503,190,b_customer_address||,||'
                                WHERE shipping_code = 'ems'";
                        $db->query($sql);
                    break;

                    case 'sf_express':
                        $sql = "UPDATE " . $ecs->table('shipping') . "
                                SET print_bg = '/images/receipt/sf_express.jpg', config_lable = 't_shop_name,网店-名称,150,29,112,137,b_shop_name||,||t_shop_address,网店-地址,268,55,105,168,b_shop_address||,||t_shop_tel,网店-联系电话,55,25,177,224,b_shop_tel||,||t_customer_name,收件人-姓名,78,23,299,265,b_customer_name||,||t_customer_address,收件人-详细地址,271,94,104,293,b_customer_address||,||'
                                WHERE shipping_code = 'sf_express'";
                        $db->query($sql);
                    break;

                    case 'zto':
                        $sql = "UPDATE " . $ecs->table('shipping') . "
                                SET print_bg = '/images/receipt/dly_zto.jpg', config_lable = 't_shop_province,网店-省份,116,30,296.55,117.2,b_shop_province||,||t_customer_province,收件人-省份,114,32,649.95,114.3,b_customer_province||,||t_shop_address,网店-地址,260,57,151.75,152.05,b_shop_address||,||t_shop_name,网店-名称,259,28,152.65,212.4,b_shop_name||,||t_shop_tel,网店-联系电话,131,37,138.65,246.5,b_shop_tel||,||t_customer_post,收件人-邮编,104,39,659.2,242.2,b_customer_post||,||t_customer_tel,收件人-电话,158,22,461.9,241.9,b_customer_tel||,||t_customer_mobel,收件人-手机,159,21,463.25,265.4,b_customer_mobel||,||t_customer_name,收件人-姓名,109,32,498.9,115.8,b_customer_name||,||t_customer_address,收件人-详细地址,264,58,499.6,150.1,b_customer_address||,||t_months,月-当日日期,35,23,135.85,392.8,b_months||,||t_day,日-当日日期,24,23,180.1,392.8,b_day||,||'
                                WHERE shipping_code = 'zto'";
                        $db->query($sql);
                    break;
                }
            }
        } //End! 新增快递单打印模式

        // 后台管理员权限中加入短信管理项
        $sql = 'SELECT action_id FROM ' . $ecs->table('admin_action') . ' WHERE action_id = 11';
        $res = $db->query($sql);

        if (!$db->fetchrow($res))
        {
            $sql = "INSERT INTO " . $ecs->table('admin_action') . "(`action_id`, `parent_id`, `action_code`, `relevance`) VALUES ('11', '0', 'sms_manage', ''), ('124', '11', 'sms_send', '')";
            $db->query($sql);
        }
    }

    function update_files()
    {
        global $ecs, $db, $prefix;
        /* 修改/data/confing.php文件,增加api时间常量 */
        if (file_exists(ROOT_PATH . 'data/config.php'))
        {
            $conf_str = file_get_contents(ROOT_PATH . 'data/config.php');
            if (!strpos($conf_str, 'API_TIME'))
            {
                $insert_pos = strpos($conf_str, '?>');
                $back_str = substr($conf_str, 0, $insert_pos) . "define('API_TIME', '');\n\n" . '?>';
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
