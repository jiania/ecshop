<?php

/* 初始化变量定义 */
$charset = 'utf-8';
$tools_version = "v1.0";
$mysql_version = '';
$ecshop_version = '';
$mysql_charset = '';
$ecshop_charset = '';
$convert_charset = array('utf-8' => 'gbk', 'gbk' => 'utf-8');
$convert_tables_file = 'data/convert_tables.php';
$rpp = 500; // 每次处理的记录数

/* ECShop的站点目录 */
define('ROOT_PATH', str_replace('\\', '/', substr(__FILE__, 0, -20)));
define('IN_ECS', true);

require(ROOT_PATH . 'data/config.php');
require(ROOT_PATH . 'includes/cls_ecshop.php');
require(ROOT_PATH . 'includes/cls_mysql.php');
require(ROOT_PATH . 'includes/lib_common.php');

/* 未升级前，该常量不存在 */
if (defined('EC_CHARSET')) {
    $ec_charset = EC_CHARSET;
} else {
    $ec_charset = '';
}
$ecshop_version = str_replace('v', '', VERSION);
$ecshop_charset = $ec_charset;
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name, '', 0, 1);
$mysql_version = $db->version;
$mysql_charset = get_mysql_charset();

$step = getgpc('step');
$step = empty($step) ? 1 : $step;

if ($ecshop_version < '2.6.0') {
    $step = 'halt';
}
if (!defined('UC_DBUSER') && !defined('UC_DBPW') && !defined('UC_DBNAME'))
{
    $uc_config = $db->getOne("SELECT value FROM {$prefix}shop_config WHERE code='integrate_config'");
    $uc_config = unserialize($uc_config);
    if (!empty($uc_config['db_user']) && !empty($uc_config['db_pass']) && !empty($uc_config['db_name']))
    {
        define('UC_CONNECT', $uc_config['uc_connect']);
        define('UC_DBHOST', $uc_config['db_host']);
        define('UC_DBUSER', $uc_config['db_user']);
        define('UC_DBPW', $uc_config['db_pass']);
        define('UC_DBNAME', $uc_config['db_name']);
        define('UC_DBCHARSET', $uc_config['db_charset']);
        define('UC_DBTABLEPRE', '`' . $uc_config['db_name'] . '`.' . $uc_config['db_pre']);
        define('UC_DBCONNECT', '0');
        define('UC_KEY', $uc_config['uc_key']);
        define('UC_API', $uc_config['uc_url']);
        define('UC_CHARSET', $uc_config['uc_charset']);
        define('UC_IP', $uc_config['uc_ip']);
        define('UC_APPID', $uc_config['uc_id']);
        define('UC_PPP', '20');
    }
    else
    {
        $step = 'halt';
    }
}

ob_start();
instheader();
if ($step == 1) {
    $ext_msg = '<a href="?step=start"><font size="3" color="red"><b>&gt;&gt;&nbsp;如果您已确认上面的使用说明,请点这里进行导入</b></font></a><br /><br /><a href="index.php"><font size="2"><b>&gt;&gt;&nbsp;如果您需要执行升级程序，请点这里进行升级</b></font></a>';
    echo <<<EOT
<h4>本转换程序只能针ECShop2.6.0或者以上版本程序的数据导入<br /></h4>
导入之前<b>务必备份数据库资料</b>，避免导入失败给您带来损失与不便<br /><br />

<p>导入程序使用说明：</p>
<ol>
    <li>只支持从UCenter数据库到ECShop数据库的导入</li>
    <li>只导入会员的用户名、邮箱、密码，这些基本信息。不会破坏原有会员数据</li>
</ol>

<p>您当前程序与数据库的信息：</p>
<ul>
    <li>程序版本：$ecshop_version</li>
    <li>程序编码：$ecshop_charset</li>
    <li>MySQL版本：$mysql_version</li>
    <li>MySQL编码：$mysql_charset</li>
</ul>
$ext_msg
EOT;
    instfooter();
} elseif ($step == 'halt') {
    echo <<<EOT
    <p><h4>出错了！</h4></p>
    <p>
        <ol>
            <li>您当前的程序版本小于2.6.0；</li>
            <li>您的配置文件与数据表中缺少UCenter的配置信息。</li>
        </ol>
    </p>
    <p><h4>请先升级您的程序再进行导入。</h4></p>
EOT;
    instfooter();
} elseif ($step == 'start') {
    $limit = getgpc('limit', 'P');
    $update = getgpc('update', 'P');
    $insert = getgpc('insert', 'P');
    $success = getgpc('success', 'P');
    $error = getgpc('error', 'P');
    $item_num = 500; // 每次处理1000个会员数据
    $statistics = array('update' => 0, 'insert' => 0, 'success' => 0, 'error' => 0);
    if (empty($limit)) {
        $limit = 0;
    }
    $uc_db = new cls_mysql(UC_DBHOST, UC_DBUSER, UC_DBPW, UC_DBNAME, UC_DBCHARSET, 0, 1);
    $total_members = $uc_db->getOne("SELECT COUNT(*) FROM ". UC_DBTABLEPRE ."members");
    $sql = "SELECT uid, username, password, email, salt FROM ". UC_DBTABLEPRE ."members ORDER BY uid ASC LIMIT $limit, $item_num";
    $uc_query = $uc_db->query($sql);
    while($member = $uc_db->fetch_array($uc_query)){
        $user_exists = $db->getOne("SELECT COUNT(*) FROM {$prefix}users WHERE `user_name`='{$member['username']}'");
        if (!$user_exists) {
            $sql = "INSERT INTO {$prefix}users (`email`, `user_name`, `password`, `salt`) VALUES('{$member['email']}', '{$member['username']}', '{$member['password']}', '2{$member['salt']}')";
            ++$statistics['insert'];
        } else {
            $sql = "UPDATE {$prefix}users SET `password`='{$member['password']}', `salt`='2{$member['salt']}' WHERE `user_name`='{$member['username']}'";
            ++$statistics['update'];
        }
        $db->query($sql);
        if ($db->affected_rows() > 0) {
            ++$statistics['success'];
        } else {
            ++$statistics['error'];
        }
    }
    if (($limit+$item_num) > $total_members) {
        $update += $statistics['update'];
        $insert += $statistics['insert'];
        $success += $statistics['success'];
        $error += $statistics['error'];
        $message = "<p>共有 <strong>$total_members</strong> 个会员数据</p><p>导入完成！</p><p><ul><li>更新的用户数据：$update 条</li><li>新增的用户数据：$insert 条</li><li>成功的用户数据：$success 条</li><li>出错的用户数据：$error 条</li></ul></p><p><a href=\"index.php\"><b>&gt;&gt;&nbsp;如果您需要执行升级程序，请点这里进行升级</b></a></p>";
        showmessage($message);
    } else {
        $update += $statistics['update'];
        $insert += $statistics['insert'];
        $success += $statistics['success'];
        $error += $statistics['error'];
        $total_item = $limit+$item_num;
        $extra = '<input type="hidden" name="update" value="'.$update.'" /><input type="hidden" name="insert" value="'.$insert.'" /><input type="hidden" name="success" value="'.$success.'" /><input type="hidden" name="error" value="'.$error.'" /><input type="hidden" name="limit" value="'.$total_item.'" />';
        $message = "<p>共有 <strong>$total_members</strong> 个会员数据</p><p>当前在导入 $limit - $total_item 的会员数据</p><p><ul><li>更新的用户数据：$update 条</li><li>新增的用户数据：$insert 条</li><li>成功的用户数据：$success 条</li><li>出错的用户数据：$error 条</li></ul></p>";
        showmessage($message, '?step=start', 'form', $extra);
    }
}
ob_end_flush();

function instheader() {
    global $charset, $tools_version;

    echo "<html><head>".
        "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$charset\">".
        "<title>UCenter 会员数据导入工具$tools_version</title>".
        "<style type=\"text/css\">
        a {
            color: #3A4273;
            text-decoration: none
        }

        a:hover {
            color: #3A4273;
            text-decoration: underline
        }

        body, table, td {
            color: #3A4273;
            font-family: Tahoma, Verdana, Arial;
            font-size: 12px;
            line-height: 20px;
            scrollbar-base-color: #E3E3EA;
            scrollbar-arrow-color: #5C5C8D
        }
        form {
            margin:0;
            padding:0
        }
        input {
            color: #085878;
            font-family: Tahoma, Verdana, Arial;
            font-size: 12px;
            background-color: #3A4273;
            color: #FFFFFF;
            scrollbar-base-color: #E3E3EA;
            scrollbar-arrow-color: #5C5C8D
        }

        .install {
            font-family: Arial, Verdana;
            font-size: 20px;
            font-weight: bold;
            color: #000000
        }

        .message {
            background: #E3E3EA;
            padding: 20px;
        }

        .altbg1 {
            background: #E3E3EA;
        }

        .altbg2 {
            background: #EEEEF6;
        }

        .header td {
            color: #FFFFFF;
            background-color: #3A4273;
            text-align: center;
        }

        .option td {
            text-align: center;
        }

        .redfont {
            color: #FF0000;
        }
        .p_indent{
            text-indent:2em;
        }
        div.msg{
            text-indent:2em;
            line-height:30px;
            height:30px;
        }
        </style>
        <script type=\"text/javascript\">
        function redirect(url) {
            window.location=url;
        }
        function $(id) {
            return document.getElementById(id);
        }
        </script>
        </head>".
        "<body bgcolor=\"#298296\" text=\"#000000\"><div id=\"append_parent\"></div>".
        "<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\" align=\"center\"><tr><td>".
              "<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"><tr>".
              "<td class=\"install\" height=\"30\" valign=\"bottom\"><font color=\"#FF0000\">&gt;&gt;</font> UCenter 会员数据导入工具$tools_version".
              "</td></tr><tr><td><hr noshade align=\"center\" width=\"100%\" size=\"1\"></td></tr><tr><td colspan=\"2\">";
}

function instfooter() {
    echo "</td></tr><tr><td><hr noshade align=\"center\" width=\"100%\" size=\"1\"></td></tr>".
            "<tr><td align=\"center\">".
                "<b style=\"font-size: 11px\">Powered by <a href=\"http://www.ecshop.com\" target=\"_blank\"><span style=\"color:#FF6100\">ECShop</span>".
              "</a></b>&nbsp; &copy; 2005-2011 上海商派网络科技有限公司。<br /><br />".
              "</td></tr></table></td></tr></table>".
        "</body></html>";
}

function showmessage($message, $url_forward = '', $msgtype = 'message', $extra = '', $delaymsec = 1000) {
    //以表单的形式显示信息
    if($msgtype == 'form') {
        $message = "<form method=\"post\" action=\"$url_forward\" name=\"hidden_form\">".
        "<br><p class=\"p_indent\">$message</p>\n $extra</form><br>".
        '<script type="text/javascript">
            setTimeout("document.forms[\'hidden_form\'].submit()", '. $delaymsec .');
        </script>';
    } else {
        if($url_forward) {
            $message .= "<script>setTimeout(\"redirect('$url_forward');\", $delaymsec);</script>";
            $message .= "<br><div align=\"right\">[<a href=\"$script_name\" style=\"color:red\">停止运行</a>]<br><br><a href=\"$url_forward\">如果您的浏览器长时间没有自动跳转，请点击这里！</a></div>";
        } else {
            $message .= "<br /><br /><br />";
        }
        $message = "<br>$message$extra<br><br>";
    }

    echo $message;
    instfooter();
    exit;
}

function get_mysql_charset() {
    global $db, $prefix;
    $tmp_charset = '';
    $query = $db->query("SHOW CREATE TABLE `{$prefix}users`", 'SILENT');
    if ($query) {
        $tablestruct = $db->fetch_array($query, MYSQL_NUM);
        preg_match("/CHARSET=(\w+)/", $tablestruct[1], $m);
        if (!empty($m)){
            if (strpos($m[1], 'utf') === 0) {
                $tmp_charset = str_replace('utf', 'utf-', $m[1]);
            } else {
                $tmp_charset = $m[1];
            }
        }
    }
    return $tmp_charset;
}

function getgpc($k, $var='G') {
    switch($var) {
        case 'G': $var = &$_GET; break;
        case 'P': $var = &$_POST; break;
        case 'C': $var = &$_COOKIE; break;
        case 'R': $var = &$_REQUEST; break;
    }
    return isset($var[$k]) ? $var[$k] : NULL;
}