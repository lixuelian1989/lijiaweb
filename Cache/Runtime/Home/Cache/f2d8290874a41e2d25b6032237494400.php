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
<div class="Kong"></div>
<div class="zhaopin_maintitle">买车流程</div>
<div class="zhaopin_main">
  <div class="zhaopin_left">
    <ul>
      <li><a href="<?php echo U('Page/index',array('name'=>'lianxiwomen'));?>">联系我们</a></li>
      <li class="hover"><a href="<?php echo U('Page/index',array('name'=>'hezuofangshi'));?>">合作方式</a></li>
      <li><a href="<?php echo U('Zhaopin/index');?>">84招聘</a></li>
    </ul>
  </div>
  <div class="zhaopin_right">
    <div class="hezuo">
    <img src="__ROOT__/Home/Tpl/default/Public/images/hezuofangshi.jpg"/>
    </div>
    <div class="hezuo font17">1.注册会员</div>
    <div class="hezuo font15">现场拍柜台办理</div>
    
    <div class="hezuo font17">2.充值保证金</div>
    <div class="hezuo font15">为了充分保障平台交易的严肃性，所有参拍客户都需要交纳一定的保证金，诚信做生意，大家都放心！</div>
    
    <div class="hezuo font17">3.竞价买车</div>
    <div class="hezuo font15">来自消费者、4S置换、厂商回购、公司处置、公务车等丰富的一手车源，车源实时更新；网络竞价和现场先看车后竞价两种方式，为您提供稳定的二手车收购渠道。看车辆报告，先投标，再竞价，心仪车辆全权掌握！</div>
    
    <div class="hezuo font17">4.先看车后付款</div>
    <div class="hezuo font15">为了让您安心购车，您可先看车后付款，一切因设备检测失误给您造成的损失由我们来承担！</div>
    <div class="hezuo font15">固定场地提车，无需东奔西跑；承诺责任担保，网上买车不担忧</div>
    <div class="hezuo font17">5.坐等提车，过户我来办</div>
    <div class="hezuo font15">
    我们组建了专业的手续代办团队，手续及证件全程封存保管，按期办理完成，及时交付车辆和证件，解放您的时间！如果需要将车运往外地，我们还有专业的二手车物流服务帮你分忧！
    </div>
    <div class="hezuo font17 tixing">
    <img src="__ROOT__/Home/Tpl/default/Public/images/xin.jpg"/>
    温馨提醒</div>
    
    
    
    <div class="hezuo font15">
    	如果您是个人买家,84PAI建议您前往专业的二手经销商购买二手车，因为84PAI拍卖平台的电子报告需要您具备专业的车况评估能力以及二手价格评估能力，才能更加准确的购买您心仪的车辆。
    </div>
    <div class="lxwm_content line ">
    </div>
    <div class="hezuo mar-top30">
    
    </div>
    
    
    <div class="maiiche_title">卖车流程</div>
    <div class="hezuo mar-top30">
    <img src="__ROOT__/Home/Tpl/default/Public/images/maiiche.jpg"/>
    </div>
    
    <div class="hezuo font17 mar-top30">1.预约车况检测</div>
    <div class="hezuo font15">您可以通过拨打客服电话010-12345或在右侧填写信息，预约评估师免费上门服务</div>
    <div class="hezuo font15">1.专业评估师会上门免费为您的车辆评估保留价。</div>
    <div class="hezuo font15">2.30分钟为您检测车况，准备网上发拍。</div>
    <div class="hezuo font17">2.网上竞拍</div>
    <div class="hezuo font15">
    使用投标加竞价的超级拍卖，超10000会员买家在线参与出价</div>
    <div class="hezuo font15">1.今天发拍，最短40分钟，最长明天就能出结果，时间随您定！</div>
    <div class="hezuo font15">2.先投标再竞价的拍卖模式，买家出价更充分，价格更高!</div>
    <div class="hezuo font15">3.拍卖结束得到最高价，若最高价超过您设置的保留价，则自动成交，若未过保留价但您对价格满意，可在2小时内选择确认成交。</div>
    <div class="hezuo font17">3.卖车成功</div>
    <div class="hezuo font15">拍卖成功，及时结款，代办过户</div>
    <div class="hezuo font15">1.确认成交后，您只要在24小时内将车送到84PAI交付场地，现场即可收取车款，最高价是多少您就收多少，无任何其他费用。</div>
    <div class="hezuo font15">2.84PAI专业手续代办团队帮您完成手续过户、交车、证件归还等后续工作，优信拍完善的交付机制让您远离繁琐，轻松卖车。
</div>
    
            
  </div>
  <div class="clear"></div>
</div>
<div class="Kong"></div>

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