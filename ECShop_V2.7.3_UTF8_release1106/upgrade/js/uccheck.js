/* 初始化一些全局变量 */
var lf = "<br />";
var iframe = null;
var notice = null;
var oriDisabledInputs = [];

/* Ajax设置 */
Ajax.onRunning = null;
Ajax.onComplete = null;

/* 页面加载完毕，执行一些操作 */
window.onload = function () {
    var f = $("js-setup");
    var ucinstalloptions = document.getElementsByName("ucinstall");


    $("js-pre-step").onclick = function() {
        location.href="./index.php?step=readme";
    };

    $("js-submit").onclick = function () {
        setupUCenter();
    }
};

/**
 * 连接Ucenter
 */
function setupUCenter()
{
   var f = $("js-setup");
   var ucinstalloptions = document.forms['js-setup'].ucinstall;
   var uccheck = true;


   if(f["js-ucapi"].value.length < 1)
   {
       $("ucapinotice").innerHTML= $_LANG["uc_api"];
        uccheck = false;
   }
   else
   {
        $("ucapinotice").innerHTML='';
   }

   if($("ucip").style.display != 'none' && f["js-ucip"].value.length < 1)
   {
       $("ucipnotice").innerHTML= $_LANG["uc_ip"];
        uccheck = false;
   }

    if (f['js-ucfounderpw'].value.length < 1)
    {
        $("ucfounderpwnotice").innerHTML= $_LANG["uc_pwd"];
        uccheck = false;
    }
    else
    {
        $("ucfounderpwnotice").innerHTML='';
    }

    if(uccheck == false)
    {
        return uccheck;
    }

    var params="ucapi=" + f["js-ucapi"].value + "&" + "ucip=" + f["js-ucip"].value + "&" + "ucfounderpw=" + f["js-ucfounderpw"].value;
    Ajax.call("./index.php?step=setup_ucenter", params, displayres, 'POST', 'JSON');
}

function displayres(res)
{
    if (res.error !== 0)
    {
        if (res.error == 2)
        {
            $("ucip").style.display = '';
        }
        $("ucfounderpwnotice").innerHTML= res.message;
    }
    else
    {
        location.href="index.php?step=usersmerge";
    }
}
