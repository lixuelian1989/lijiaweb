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
    <P class="p2"><img src="__PUBLIC__/web/images/tx4_04.png" /></P>
    <div class="yz">
        <form name="form1" id="form1" enctype="" method="post" action="">
        <P class="p3"><span class="span1">请选择验证方式：</span>
            <select name="yzfs" id="yzfs">
                <option value="">请选择</option>
                <?php if(is_array($yzfs)): $k = 0; $__LIST__ = $yzfs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>" ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </P>
        
        <P class="p3" id="email_tb" style="display:none"><span class="span1">您的邮箱 ：</span><span class="ema"><?php echo ($yzdata[email]); ?></span><a href="javascript:fs_email('<?php echo ($yzdata[email]); ?>');">点击发送验证邮件</a></P>
        <P class="p3" id="phone_tb" style="display:none"><span class="span1">您的手机 ：</span><span class="ema"><?php echo ($yzdata[phone]); ?></span><a href="javascript:fs_phone('<?php echo ($yzdata[phone]); ?>');">点击发送验证码</a></P>
        
        
        <P class="p3"><span class="span1">验证码 ：</span><input class="yzm" name="yzm" id="yzm" type="text" /></P>
        <input type="hidden" id="step" name="step" value="<?php echo ($step); ?>" />
        <input type="hidden" id="username" name="username" value="<?php echo ($username); ?>" />
        
        <P class="p4"><input class="ss" type="submit"  value="下一步"/></P>
        </form>
    </div>
</div>
<script>
$("#form1").submit(function(){
	var yzfs=$("#yzfs").val();
	
	yzfs=$.trim(yzfs);
	var yzm=$("#yzm").val();
	yzm=$.trim(yzm);
                
	if(yzfs==""){
            alert("请选择验证方式!");
            return false;
	}
        if(yzm==""){
            alert("请填写验证码!");
            return false;
	}
        
});
$("#yzfs").change(function(){
    var yzfs=$(this).val();
    if(yzfs==1){
        $("#email_tb").show();
		$("#phone_tb").hide();
    }else if(yzfs==2){
        $("#email_tb").hide();
        $("#phone_tb").show();
    }else{
        $("#email_tb").hide();
        $("#phone_tb").hide();
    }
});
function fs_email(email){
	
    $.ajax({
		data:"email="+email,
		cache:false,
		dataType:"JSON",
		type:"POST",
		url:"<?php echo U('Member/send_email');?>",
		success: function(msg){
			alert(msg.msg);
			}
		});
}
function fs_phone(phone){
	 $.ajax({
		data:"phone="+phone,
		cache:false,
		dataType:"JSON",
		type:"POST",
		url:"<?php echo U('Member/send_phone');?>",
		success: function(msg){
			alert(msg.msg);
			}
		});
}
</script>
</body>
</html>