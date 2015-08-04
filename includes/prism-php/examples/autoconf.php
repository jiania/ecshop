<?php
error_reporting(E_ALL ^ E_NOTICE);

if($_REQUEST['token']) {
    //2.x 绗?簩姝? Prism鏈嶅姟鍣ㄦ牴鎹畉oken鑾峰彇閰嶇疆鍙傛暟
    $_REQUEST['token'] = preg_replace("/[^A-z0-9]/",'',$_REQUEST['token');
    get_args_by_token($_REQUEST['token']);
}else{
    //1.x 绗?竴姝? 浜哄伐浜や簰杩囩▼
    create_new_token();
}

function create_new_token(){
    switch($_REQUEST['step']){

        // 1.1 鐢ㄦ埛浜や簰娴佺▼瀹屾瘯,
        //     淇濆瓨閰嶇疆鍙傛暟鍒颁复鏃跺瓨鍌? 浜х敓涓€涓??搴旂殑token. 骞惰烦杞?洖callback
        case 'finish':
            $args = $_POST['p'];
            $token = md5(time(). print_r($_SERVER, 1));

            file_put_contents('/tmp/'.$token, serialize($args));
            $redirect = $_REQUEST['callback'].'?token='.urlencode($token);
            header('Location: '.$redirect);
            break;

        //1.0 绗?竴姝? 灞曠幇椤甸潰. 
        //    鍙?互鏀剧疆韬?唤璁よ瘉绛夎嫢骞查〉闈㈡祦绋? 鍙??鏈€鍚庝竴姝ヨ兘璺宠浆鍒癱allback鍗冲彲.
        default :
            echo <<<EOF
<html>
    <h1>Set Params</h1>
    <hr />
    <form action="?step=finish" method="post">
        <input type="hidden" name="callback" value="{$_REQUEST['callback']}" />
        <pre>
        shop_id    <input type="text" name="p[shop_id]" value="testid123" />
        app_secret <input type="text" name="p[api_secret]" value="secret9527" />

        <input type="submit" />
        </pre>
    </form>
</html>
EOF;
    }

}


// 2.0 鏍规嵁token鑾峰彇閰嶇疆鍙傛暟, 鐢熸垚json浠ｇ爜杩斿洖缁檖rism
function get_args_by_token($token){
    $token_file = '/tmp/'.$token;
    if(file_exists($token_file)){
        $data = file_get_contents($token_file);
        if ($data) {
            $data = unserialize($data);
            echo json_encode($data);
        }
        unlink($token_file);
    }
}