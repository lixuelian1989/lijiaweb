<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
        <meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">

        <script type="text/javascript" src="__ROOT__/Home/Tpl/default/Public/js/jquery-1.8.3.min.js"></script>
    </head>

    <body>
        <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">
            <div class="yhm">
                <input class="yhtext" type="text" id="uname" name="uname" placeholder="用户名 或者 手机号码" />
                <div class="yhm_tb"></div>
            </div>
            <div class="yhm">
                <input class="yhtext" type="password" id="upwd" name="upwd" placeholder="密码" />
                <div class="yhm_tb mm"></div>
            </div>
            <div class="dlbt">
                <input type="submit" value="登录" onClick="sub_login()" />
                <a href="<?php echo U('User/regist');?>">注册</a> </div>
        </form>  
        <script>
            function sub_login() {
                if ($("#uname").val() == '' || $("#upwd").val() == '') {
                    alert("填写完整方可登陆");
                    return false;
                }
                commonAjaxSubmit();
            }
            ;
        </script>
    </body>
</html>