<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员登录_<?php echo ($site["SITE_INFO"]["name"]); ?></title>
<link rel="stylesheet" href="__PUBLIC__/web/css/main.css" type="text/css" media=" screen"/>
<script src="__PUBLIC__/web/js/jquery-1.8.2.min.js"></script>
</head>

<body>
<div class="logo">
  <h3><a href="<?php echo U('Index/index');?>"><img src="__PUBLIC__/web/images/index_07.png" /></a></h3>
  <P>会员登录</P>
</div>
<div class="dl"> <img class="img1" src="__PUBLIC__/web/images/dl_03.png">
  <div class="dl_c">
    <form action="" name="form1" id="form1" method="post" enctype="multipart/form-data">
      <input class="tt" name="username" id="username" value="" placeholder="用户名/邮箱/手机号码" type="text">
      <input class="pp" id="pwd" name="pwd" value="" placeholder="请输入密码" type="password">
      <input class="ss" id="sub" name="sub" value="登陆" type="submit">
      <p class="p1"><a href="<?php echo U('Member/find_pwd',array('step'=>1));?>">忘记密码</a> | <a href="<?php echo U('Member/register');?>">立即注册</a></p>
      <p class="p2">使用第三方账号登录：<a class="a1" href="#"></a> | <a class="a2" href="#"></a> | <a class="a3" href="#"></a></p>
    </form>
  </div>
</div>
<script>
$("#form1").submit(function(){
	var username=$("#username").val();
	var pwd=$("#pwd").val();
	
	username=$.trim(username);
	pwd=$.trim(pwd);
	
	if(username==""){
		alert("账户名不能为空!");
		return false;
	}
	if(pwd==""){
		alert("密码不能为空!");
		return false;
	}
	
});
</script>
</body>
</html>