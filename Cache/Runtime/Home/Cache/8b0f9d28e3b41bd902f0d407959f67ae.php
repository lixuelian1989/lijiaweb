<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
<meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">
<link rel="stylesheet" type="text/css" href="__ROOT__/Home/Tpl/default/Public/css/public.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Home/Tpl/default/Public/css/style.css" />
</head>

<body>
<div class="Head">
	<div class="M">
    	<div class="l">
        	<a href="index.html"><img src="__ROOT__/Home/Tpl/default/Public/images/zc_img1.jpg"></a>
        </div>
        <div class="r">
        	<?php if(isset($_SESSION[user_info])): ?><p><a href='<?php echo U("User/center");?>'>进入会员中心</a>
            <a href='<?php echo U("User/logout");?>'>退出</a>
            </p>
            <?php else: ?>
            <p><a href="" class="popbox-link popbox-link02">会员入口</a><a href="<?php echo U('User/xieyi');?>">加入会员</a></p><?php endif; ?>
            
            
            <a href="" class="Head_Auction">拍卖入口</a>
            <h2>汽车服务专家<span>400-12345678</span></h2>
        </div>
    </div>
</div>

<div class="Head_nav">
  <div class="M"> <a href="<?php echo U('Index/index');?>">首页</a> <a href="">我要卖车</a> <a href="">我要置换</a> <a href="<?php echo U('news/index');?>" class="active">84资讯</a> <a href="">84分享</a> <a href="">团新车</a> </div>
</div>


<div class="Head_nav_xia">
	<a href="<?php echo U('news/index');?>">84资讯  ></a>
</div>

<div class="Kong"></div>
<div class="M Replacement_advertis">
	<img src="__ROOT__/Home/Tpl/default/Public/images/zc_img28.jpg" />
</div>
<div class="Kong"></div>

<div class="M Delivery_cont">
	<h2>服务声明</h2>
    <div class="Service_cont">
    	<h3>内 容</h3>
       <?php echo ($info["content"]); ?>
    </div>
</div>




<div class="Foot">
  <div class="Foot_nav"> 
      
      <a href="<?php echo U('Page/index',array('name'=>'lianxiwomen'));?>" target='_blank'>联系我们</a>| <a href="<?php echo U('Page/index',array('name'=>'hezuofangshi'));?>">合作方式</a>| <a href="<?php echo U('Zhaopin/index');?>" target="_blank">84招聘</a>| <a href="<?php echo U('Page/index',array('name'=>'fuwushengming'));?>">服务声明</a> 
  
  
  </div>
  <p>CopyRight © 2014 84PAI All Rights Reserved 版权所有 84PAI信息技术有限公司</p>
  <p>经营许可证编号：京ICP证124567号；公安备案号码：京公网安备11321231313；工商投诉电话010-00000003</p>
</div>
<div id="screen"></div>
<!--screen end-->
<div style="position: absolute; top:50%; left:50%; display: none;" class="popbox popbox02">
  <div class="Sell_close">
    <h3>登录</h3>
    <a href=""><img src="__ROOT__/Home/Tpl/default/Public/images/zc_img16.jpg" /></a></div>
  <div class="Login_table">
	<form name="form1" id="form1" enctype="multipart/form-data" method="post" action="<?php echo U('User/index');?>">
    <div class="Login_list">
      <label></label>
      <img src="__ROOT__/Home/Tpl/default/Public/images/zc_img34.jpg" /> </div>
    <div class="Login_list">
      <label>帐 号：</label>
      <input class="yhtext Login_txt" type="text" id="uname" name="uname" placeholder="用户名 或者 手机号码" />
      <div class="yhm_tb"></div>
    </div>
    <div class="Login_list">
      <label>密 码：</label>
      <input class="yhtext Login_txt" type="password" id="upwd" name="upwd" placeholder="密码" />
    </div>
    <div class="Login_list">
      <label></label>
      <input type="checkbox" name="rember" id="rember" value="1" />
      <em>记住我</em><a href="">忘记密码</a> </div>
    <div class="Login_list">
      <label></label>
      <input type="submit" class="Login_sub" value="登录" onClick="sub_login()" />
      <a href="<?php echo U('User/regist');?>" class="Index_Z">注册会员>></a> </div>
	</form>
  </div>
</div>
<!--popbox end--> 

<script type="text/javascript" src="__ROOT__/Home/Tpl/default/Public/js/jquery.1.4.2-min.js"></script> 
<script type="text/javascript" src="__ROOT__/Home/Tpl/default/Public/js/jquery.cookie.js"></script> 

<script type="text/javascript">
	$(document).ready(function(){
		$('.close-btn').click(function(){
			$('.popbox').fadeOut(function(){ $('#screen').hide(); });
			return false;
		});
		
		$('.popbox-link').click(function(){
			var h = $(document).height();
			$('#screen').css({ 'height': h });	
			$('#screen').show();
			$('.popbox').center();
			$('.popbox').fadeIn();
			return false;
		});
		
	});
	
	jQuery.fn.center = function(loaded) {
		var obj = this;
		body_width = parseInt($(window).width());
		body_height = parseInt($(window).height());
		block_width = parseInt(obj.width());
		block_height = parseInt(obj.height());
		
		left_position = parseInt((body_width/2) - (block_width/2)  + $(window).scrollLeft());
		if (body_width<block_width) { left_position = 0 + $(window).scrollLeft(); };
		
		top_position = parseInt((body_height/2) - (block_height/2) + $(window).scrollTop());
		if (body_height<block_height) { top_position = 0 + $(window).scrollTop(); };
		
		if(!loaded) {
			
			obj.css({'position': 'absolute'});
			obj.css({ 'top': top_position, 'left': left_position });
			$(window).bind('resize', function() { 
				obj.center(!loaded);
			});
			$(window).bind('scroll', function() { 
				obj.center(!loaded);
			});
			
		} else {
			obj.stop();
			obj.css({'position': 'absolute'});
			obj.animate({ 'top': top_position }, 200, 'linear');
		}
	}
</script> 
<script>
	function sub_login() {
    	if ($("#uname").val() == '' || $("#upwd").val() == '') {
        	alert("填写完整方可登陆");
            return false;
        }
        	commonAjaxSubmit();
	}
	var rem;
	rem=$.cookie("rember");
	if(rem!=''){
rem=		eval("("+rem+")");
	$("#uname").val(rem.uname);
	$("#upwd").val(rem.upwd);	
	
	}
</script>
</body></html>