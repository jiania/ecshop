<?php
require_once('../lib/provider.php');

//瀹氫箟api
$provider = new prism_provider();

$provider->add("get_id_by_domain", 
        prism_api("id",
            prism_params("arg1", "useinput"),
            prism_params("arg2", "useinput"),
            prism_params("arg3", "useinput"),
            prism_params("arg4", "useinput")
        )
    );

//鏈?緥鎴戜滑鍦ㄤ笅闈?細璋冪敤distach, 鍥犳?api鐨勫悗绔??涓哄綋鍓嶈?闂?湴鍧€
$provider->set_url($_SERVER['DOCUMENT_URI']);

//璁剧疆绛惧悕鏂瑰紡
// $provider->set_validation("prism_sign_validation", "get_secret_by_key");

//璁剧疆鍏蜂綋鐨刟pi璋冪敤
$provider->handler(new api_handler);

if(array_key_exists('show_api_json', $_GET)){
    $provider->output_json();
}elseif(array_key_exists("method", $_REQUEST)){
    $provider->dispatch($_REQUEST["method"]);
}else{
    echo <<<EOF
        <a href="?show_api_json">json</a>
EOF;
}

class api_handler{

    function get_id_by_domain($params){
        return $_SERVER;
    }

}
