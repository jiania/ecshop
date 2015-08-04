<?php

/**
 * ECSHOP v2.5.0 升级程序
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
 * $Id: v2.5.0.php 17217 2011-01-19 06:29:08Z liubo $
 */

class up_v2_5_0
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
    function up_v2_5_0(){}

    function update_database_optionally()
    {
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/inc_constant.php');
        include_once(ROOT_PATH . 'includes/lib_common.php');

        /* 插入夺宝奇兵活动数据：必须排在团购活动前（id不变） */
        $sql = "SELECT s.*, a.name, a.start_time, a.end_time, description, IFNULL(g.goods_name, '') AS goods_name " .
                "FROM " . $ecs->table('snatch') . " AS s " .
                    "LEFT JOIN " . $ecs->table('activity') . " AS a ON s.activity_id = a.activity_id " .
                    "LEFT JOIN " . $ecs->table('goods') . " AS g ON s.goods_id = g.goods_id " .
                    "WHERE a.name IS NOT NULL";
        $res = $db->query($sql, 'SILENT');
        if ($res)
        {
            while ($row = $db->fetchRow($res))
            {
                $activity = array(
                    'act_name'    => $row['name'],
                    'act_desc'    => $row['description'],
                    'act_type'    => GAT_SNATCH,
                    'goods_id'    => $row['goods_id'],
                    'goods_name'  => $row['goods_name'],
                    'start_time'  => ($row['start_time'] - date('Z')),
                    'end_time'    => ($row['end_time'] - date('Z')),
                    'is_finished' => 0,
                    'ext_info'    => serialize(array(
                                'start_price' => $row['min_price'],
                                'end_price'   => $row['max_price'],
                                'max_price'   => $row['price'],
                                'cost_points' => $row['integral']))
                );
                $db->autoExecute($ecs->table('goods_activity'), $activity, 'INSERT', '', 'SILENT');
            }
        }

        /* 插入团购活动数据：必须排在夺宝奇兵活动后（id要变） */
        $sql = "SELECT gb.*, IFNULL(g.goods_name, '') AS goods_name " .
                "FROM " . $ecs->table('group_buy') . " AS gb " .
                    "LEFT JOIN " . $ecs->table('goods') . " AS g ON gb.goods_id = g.goods_id";
        $res = $db->query($sql, 'SILENT');
        if ($res)
        {
            while ($row = $db->fetchRow($res))
            {
                $activity = array(
                    'act_name'    => $row['goods_name'],
                    'act_desc'    => $row['group_buy_desc'],
                    'act_type'    => GAT_GROUP_BUY,
                    'goods_id'    => $row['goods_id'],
                    'goods_name'  => $row['goods_name'],
                    'start_time'  => ($row['start_date'] - date('Z')),
                    'end_time'    => ($row['end_date'] - date('Z')),
                    'is_finished' => $row['is_finished'],
                    'ext_info'    => serialize(array(
                                'price_ladder'    => unserialize($row['price_ladder']),
                                'restrict_amount' => $row['restrict_amount'],
                                'gift_integral'   => $row['gift_integral'],
                                'deposit'         => $row['deposit']))
                );
                $db->autoExecute($ecs->table('goods_activity'), $activity, 'INSERT', '', 'SILENT');
                $activity['act_id'] = $db->insert_id();

                /* 更新订单表 */
                $sql = "UPDATE " . $ecs->table('order_info') .
                        " SET extension_id = '$activity[act_id]'" .
                        " WHERE extension_code = 'group_buy'" .
                        " AND extension_id = '$row[group_buy_id]'";
                $db->query($sql);
            }
        }

        /* 删除不用的表 */
        $sql = "DROP TABLE IF EXISTS " . $ecs->table('activity');
        $db->query($sql);

        $sql = "DROP TABLE IF EXISTS " . $ecs->table('snatch');
        $db->query($sql);

        $sql = "DROP TABLE IF EXISTS " . $ecs->table('group_buy');
        $db->query($sql);

        /* 把原 user_account 中的数据导入 account_log ，并初始化积分 */
        $sql = "SELECT value FROM " . $ecs->table('shop_config') . " WHERE code = 'lang'";
        $lang = $db->getOne($sql);
        if (!in_array($lang, array('zh_cn', 'zh_tw', 'en_us')))
        {
            $lang = 'zh_cn';
        }
        $change_type = array(
            'zh_cn' => $GLOBALS['_LANG']['update_v250']['zh_cn'],
            'zh_tw' => $GLOBALS['_LANG']['update_v250']['zh_tw'],
            'en_us' => $GLOBALS['_LANG']['update_v250']['en_us']
        );

        $sql = "SELECT * FROM " . $ecs->table('user_account') . " WHERE user_id > 0 AND is_paid = 1";
        $res = $db->query($sql, 'SILENT');
        if ($res)
        {
            while ($row = $db->fetchRow($res))
            {
                $account_log = array(
                    'user_id'       => $row['user_id'],
                    'user_money'    => $row['amount'],
                    'frozen_money'  => 0,
                    'rank_points'   => 0,
                    'pay_points'    => 0,
                    'change_time'   => $row['paid_time'],
                    'change_desc'   => $change_type[$lang][$row['process_type']],
                    'change_type'   => $row['process_type'] < 2 ? $row['process_type'] : ACT_OTHER
                );
                $db->autoExecute($ecs->table('account_log'), $account_log, 'INSERT', '', 'SILENT');
            }
        }

        $sql = "SELECT user_id, rank_points, pay_points " .
                "FROM " . $ecs->table('users') .
                " WHERE rank_points > 0 OR pay_points > 0";
        $res = $db->query($sql);
        while ($row = $db->fetchRow($res))
        {
            $account_log = array(
                'user_id'       => $row['user_id'],
                'user_money'    => 0,
                'frozen_money'  => 0,
                'rank_points'   => $row['rank_points'],
                'pay_points'    => $row['pay_points'],
                'change_time'   => time(),
                'change_desc'   => $change_type[$lang]['init'],
                'change_type'   => ACT_OTHER
            );
            $db->autoExecute($ecs->table('account_log'), $account_log, 'INSERT');
        }

        /* 设置服务器的时区 */
        $timezone = server_timezone();
        $sql = "UPDATE " . $ecs->table('shop_config') . " SET value = '$timezone' WHERE code = 'timezone'";
        $db->query($sql);

        $this->convert_datetime();

        /* 文章分类调整 */
        $sql = "SELECT cat_id FROM " . $ecs->table('article_cat') . " WHERE cat_type = 2";
        $parent_id = $db->getOne($sql);
        $sql = "UPDATE " . $ecs->table('article_cat') . " SET parent_id = '$parent_id' WHERE cat_type = 3 or cat_type= 4";
        $db->query($sql);
        $sql = "SELECT cat_id FROM " . $ecs->table('article_cat') . " WHERE cat_type = 4";
        $parent_id = $db->getOne($sql);
        $sql = "UPDATE " . $ecs->table('article_cat') . " SET parent_id = '$parent_id', cat_type = 5 WHERE cat_type = 0";
        $db->query($sql);
        $sql = "SELECT cat_id FROM " . $ecs->table('article_cat') . " WHERE cat_type = 3";
        $parent_id = $db->getOne($sql);
        $sql = "UPDATE " . $ecs->table('article') . " SET cat_id = '$parent_id' WHERE cat_id = 0";
        $db->query($sql);

        // flash播放器升级
        $out = '<?xml version="1.0" encoding="utf-8"?><bcaster>';
        $_CFG['shop_slagon'] = $db->getOne("SELECT value FROM " . $ecs->table('shop_config') . " WHERE code = 'shop_slagon'");
        if (!empty($_CFG['shop_slagon']) && file_exists(str_replace('../', '', $_CFG['shop_slagon'])))
        {
            $out .=  '<item item_url="'. str_replace('../', '', $_CFG['shop_slagon']). '" link="" />';
        }

        $sql = 'SELECT goods_id, goods_name, cycle_img, RAND() AS rand ' .
               'FROM ' . $ecs->table('goods') . " WHERE cycle_img > '' AND is_delete = '0' ORDER BY rand LIMIT 8";
        $res = $db->getAll($sql);

        foreach ($res AS $row)
        {
            $out .= '<item item_url="' .$row['cycle_img']. '" link="'. build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']). '" />';
        }

        $out .= '</bcaster>';
        file_put_contents(ROOT_PATH . 'data/cycle_image.xml', $out);
        $db->query("DELETE FROM " . $ecs->table('shop_config') . " WHERE code = 'shop_slagon' LIMIT 1");

        /* 写入 hash_code，做为网站唯一性密钥 */
        $hash_code = md5(md5(time()) . md5($db->dbhash) . md5(time()));
        $sql = "UPDATE " . $ecs->table('shop_config') . " SET value = '$hash_code' WHERE code = 'hash_code' AND value = ''";
        $db->query($sql);

        /* 验证码部分迁移 */
        $captcha = 0;
        $sql = "SELECT value FROM " . $ecs->table('shop_config') . " WHERE code ='enable_captcha'";
        if ($db->getOne($sql))
        {
            $captcha = $captcha | CAPTCHA_ADMIN;
        }
        $sql = "SELECT value FROM " . $ecs->table('shop_config') . " WHERE code ='comment_captcha'";
        if ($db->getOne($sql))
        {
            $captcha = $captcha | CAPTCHA_COMMENT;
        }
        $sql = "UPDATE " . $ecs->table('shop_config') . " SET value = '$captcha' WHERE code='captcha'";
        $db->query($sql);
        $sql = "DELETE FROM " . $ecs->table('shop_config') . " WHERE code IN ('enable_captcha', 'comment_captcha')";
        $db->query($sql);

        /* 赠品活动升级 gift_type 和 gift 表用 favourable_activity 代替 */
        $sql = "SELECT rank_id FROM " . $ecs->table('user_rank');
        $user_rank = $db->getCol($sql);
        $user_rank = empty($user_rank) ? '0' : join(',', $user_rank);

        $sql = "SELECT *, UNIX_TIMESTAMP(start_date) AS start_time, UNIX_TIMESTAMP(end_date) AS end_time FROM " . $ecs->table('gift_type');
        $res = $db->query($sql, 'SILENT');
        if ($res)
        {
            while ($row = $db->fetchRow($res))
            {
                $sql = "SELECT gi.goods_id AS id, go.goods_name AS name, gi.goods_price AS price " .
                        "FROM " . $ecs->table('gift') . " AS gi, " . $ecs->table('goods') . " AS go " .
                        "WHERE gi.goods_id = go.goods_id";
                $gift = serialize($db->getAll($sql));
                $param = unserialize($row['param']);
                $favourable = array(
                    'act_id'        => $row['gift_type_id'],
                    'act_name'      => $row['gift_type_name'],
                    'start_time'    => $row['start_time'] - date('z'),
                    'end_time'      => $row['end_time'] - date('z'),
                    'user_rank'     => $user_rank,
                    'act_range'     => FAR_ALL,
                    'act_range_ext' => '',
                    'min_amount'    => $param['min_amount'],
                    'max_amount'    => $param['max_amount'],
                    'act_type'      => FAT_GOODS,
                    'act_type_ext'  => $row['max_count'],
                    'gift'          => $gift
                );
                $db->autoExecute($ecs->table('favourable_activity'), $favourable, 'INSERT', '', 'SILENT');
            }
        }

        $sql = "DROP TABLE IF EXISTS " . $ecs->table('gift_type');
        $db->query($sql);
        $sql = "DROP TABLE IF EXISTS " . $ecs->table('gift');
        $db->query($sql);

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
        global $ecs, $db, $prefix;

        include_once(ROOT_PATH . 'includes/lib_common.php');

        /* 广告时间格式转换 */
        $sql = "UPDATE " . $ecs->table('ad') . " SET ".
                "start_time = (UNIX_TIMESTAMP(start_date) - " .date('Z') . "), " .
                "end_time = (UNIX_TIMESTAMP(end_date) - " .date('Z') . ") ";
        $db->query($sql);

        /* 管理员日志的时间转换为GMT */
        $sql = "UPDATE " .$ecs->table('admin_log'). " SET ".
                "log_time = (log_time - " .date('Z'). ")";
        $db->query($sql);

        /* 管理员留言的时间格式转换 */
        $sql = "UPDATE " . $ecs->table('admin_message') . " SET ".
                "sent_time = (UNIX_TIMESTAMP(send_date) - " .date('Z') . "), " .
                "read_time = (UNIX_TIMESTAMP(read_date) - " .date('Z') . ") ";
        $db->query($sql);

        /* 管理员帐号的时间格式转换 */
        $sql = "UPDATE " . $ecs->table('admin_user') . " SET ".
                "add_time = (UNIX_TIMESTAMP(join_time) - " .date('Z') . "), " .
                "last_login = (UNIX_TIMESTAMP(last_time) - " .date('Z') . ") ";
        $db->query($sql);

        /* 文章的时间转换为GMT */
        $sql = "UPDATE " .$ecs->table('article'). " SET ".
                "add_time = (add_time - " .date('Z'). ")";
        $db->query($sql);

        /* 红包类型的时间转换为GMT */
        $sql = "UPDATE " . $ecs->table('bonus_type') . " SET ".
                "send_start_date = (UNIX_TIMESTAMP(send_startdate) - " .date('Z') . "), " .
                "send_end_date = (UNIX_TIMESTAMP(send_enddate) - " .date('Z') . "), " .
                "use_start_date = (UNIX_TIMESTAMP(use_startdate) - " .date('Z') . "), " .
                "use_end_date = (UNIX_TIMESTAMP(use_enddate) - " .date('Z') . ") ";
        $db->query($sql);

        /* 缺货登记的时间转换为GMT */
        $sql = "UPDATE " .$ecs->table('booking_goods'). " SET ".
                "booking_time = (booking_time - " .date('Z'). ")," .
                "dispose_time = (dispose_time - " .date('Z'). ")";
        $db->query($sql);

        /* 收藏商品的时间格式转换为GMT */
        $sql = "UPDATE " . $ecs->table('collect_goods') . " SET ".
                "add_time = (UNIX_TIMESTAMP(collect_time) - " .date('Z') . ") ";
        $db->query($sql);

        /* 评论的时间转换为GMT */
        $sql = "UPDATE " .$ecs->table('comment'). " SET ".
                "add_time = (add_time - " .date('Z'). ")";
        $db->query($sql);

        /* 用户留言的时间转换为GMT */
        $sql = "UPDATE " .$ecs->table('feedback'). " SET ".
                "msg_time = (msg_time - " .date('Z'). ")";
        $db->query($sql);

        /* 商品数据时间格式转换为GMT */
        $sql = "UPDATE " . $ecs->table('goods') . " SET ".
                "promote_start_date = (UNIX_TIMESTAMP(promote_start) - " .date('Z') . "), " .
                "promote_end_date = (UNIX_TIMESTAMP(promote_end) - " .date('Z') . "), ".
                "add_time = (add_time - " .date('Z'). "), ".
                "last_update = (last_update - " .date('Z'). ")";
        $db->query($sql);

        /* 订单处理日志时间格式转换 */
        $sql = "UPDATE " . $ecs->table('order_action') . " SET ".
                "log_time = (UNIX_TIMESTAMP(action_time) - " .date('Z') . ") ";
        $db->query($sql);

        /* 订单信息时间格式转换为GMT */
        $sql = "UPDATE " . $ecs->table('order_info') . " SET ".
                "add_time = (UNIX_TIMESTAMP(order_time) - " .date('Z') . "), " .
                "pay_time = (pay_time - " .date('Z') . "), ".
                "confirm_time = (confirm_time - " .date('Z') . "), ".
                "shipping_time = (shipping_time - " .date('Z') . ") ";
        $db->query($sql);

        /* 会员表格式转换 */
        $sql = "UPDATE " . $ecs->table('users') . " SET ".
                "reg_time = (reg_time - " .date('Z') . "), ".
                "last_login = (UNIX_TIMESTAMP(last_time) - " .date('Z') . ") ";
        $db->query($sql);

        /* 会员帐号时间格式转换 */
        $sql = "UPDATE " . $ecs->table('user_account') . " SET ".
                "add_time = (add_time - " .date('Z') . "), ".
                "paid_time = (paid_time - " .date('Z') . ") ";
        $db->query($sql);

        /* 会员红包时间格式转换 */
        $sql = "UPDATE " . $ecs->table('user_bonus') . " SET ".
                "used_time = (used_time - " .date('Z') . ") ";
        $db->query($sql);

        /* 调查时间格式转换 */
        $sql = "UPDATE " . $ecs->table('vote') . " SET ".
                "start_time = (UNIX_TIMESTAMP(start_time) - " .date('Z') . "), ".
                "end_time = (UNIX_TIMESTAMP(end_time) - " .date('Z') . ") ";
        $db->query($sql);

        /* 调查日志时间格式转换 */
        $sql = "UPDATE " . $ecs->table('vote_log') . " SET ".
                "vote_time = (vote_time - " .date('Z') . ") ";
        $db->query($sql);

    }
}

?>
