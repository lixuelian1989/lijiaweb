<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>找回密码_<?php echo ($site["SITE_INFO"]["name"]); ?></title>
<link rel="stylesheet" href="__PUBLIC__/web/css/main.css" type="text/css" media=" screen"/>
<script src="__PUBLIC__/web/js/jquery-1.8.2.min.js"></script>
</head>

<body>
    <div class="nav_t">
	<div class="nav_t_c">
    	<p class="p1">欢迎进入利嘉商圈！</p>
        <p class="p4"><a href="#">加入收藏</a></p>
        <p class="p2"><a href="<?php echo U('Member/index');?>">我的商圈</a></p>
        <p class="p3"><a href="<?php echo U('Member/login');?>">登录</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="<?php echo U('Member/register');?>">注册</a></p>
    </div>
</div>

<div class="logo">
	<h3><a href="#"><img src="__PUBLIC__/web/images/index_07.png" /></a></h3>
    <P>安全中心</P>
</div>
<div class="aq">
    <P class="p1"><a href="#">安全中心</a> > <a href="<?php echo U('Member/find_pwd',array('step'=>1));?>">找回密码</a></P>	
    <P class="p2"><img src="__PUBLIC__/web/images/tx4_03.png" /></P>
    <P class="cg">重置密码成功，<a href="<?php echo U('Member/login');?>">点击登陆</a></P>
</div>
<script>
$("#form1").submit(function(){
    var pwd=$("#pwd").val();
	
	pwd=$.trim(pwd);
	var conf_pwd=$("#conf_pwd").val();
	
	conf_pwd=$.trim(conf_pwd);
	
	if(pwd==""){
		alert("请输入密码!");
		return false;
	}
        if(conf_pwd==""){
		alert("请输入密码!");
		return false;
	}
        if(pwd!=conf_pwd){
            alert("两次输入的密码不一致!")
            return false;
        }
});
</script>
</body>
</html>