<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
    <meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">
    <link rel="stylesheet" type="text/css" href="__ROOT__/Home/Tpl/default/Public/css/public.css" />
</head>
<style type="text/css">
body{ background:url(__ROOT__/Home/Tpl/default/Public/images/bg2_01.jpg) no-repeat top center}
</style>
<body>

<div class="topnav"><a href="?l=zh-cn">中文</a>&nbsp;|&nbsp;<a href="?l=zh-en">英文</a></div>
<div class="deltop">
	<div class="logobox l"><a href="<?php echo U('index/index');?>"><img src="__ROOT__/Home/Tpl/default/Public/images/logo.png" /></a></div>	
    <div class="fhsy"><a href="<?php echo U('Index/index');?>">返回首页</a></div>  
</div>
<div class="dlbg">
  <div class="dltit">项目管理系统</div>
    <div class="dlck">
    	<div class="yhm">
        	<input class="yhtext" type="text" placeholder="用户名" />
             <div class="yhm_tb"></div>
        </div>
      <div class="yhm">
          <input class="yhtext" type="text" placeholder="密码" />
          <div class="yhm_tb mm"></div>
      </div>
      <div class="yzm"><input type="text" /><img src="__ROOT__/Home/Tpl/default/Public/images/bt_08.jpg" /><a href="#">换一张</a></div>
      <div class="dlbt">
      	<input type="button" value="登录" /><a href="#">注册</a>
      </div>
      
    </div>
	
</div>
<div class="footer">
	版权所有 © 锐驰莱德信息技术（北京）有限公司 　ICP:京ICP备13038052号<br />

地址：北京市海淀区安宁庄西路9号宜品上层一单元403室
</div>

<?php echo ($site["SITE_INFO"]["tongji"]); ?>



</body>
</html>
<div class="cenav"><a href="<?php echo U('Servicetype/index');?>">业务类型</a><a href="<?php echo U('Project/index');?>">项目管理</a><a href="<?php echo U('regulations/index');?>">法规月报</a><a href="<?php echo U('Lawssystem/index');?>">法规系统</a></div>