<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
    <meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">
    <link rel="stylesheet" type="text/css" href="__ROOT__/Home/Tpl/default/Public/css/public.css" />
</head>

<body>
<div class="top">
	<div class="logobox l"><a href="<?php echo U('index/index');?>"><img src="__ROOT__/Home/Tpl/default/Public/images/logo.png" /></a></div>	
    <div class="navbox r">
    	<ul>
        	<li><p><a href="<?php echo U('news/index');?>?l=zh-cn">新闻动态</a></p><p class="yw"><a href="<?php echo U('news/index');?>?l=zh-en">News</a></p></li>
            <li><p><a href="<?php echo U('page/index',array('name'=>'gywm'));?>?l=zh-cn">关于我们  </a></p><p class="yw"><a href="<?php echo U('page/index',array('name'=>'gywm'));?>?l=zh-en">About</a></p></li>
            <li><p><a href="<?php echo U('page/index',array('name'=>'lxwm'));?>?l=zh-cn">联系我们</a></p><p class="yw"><a href="<?php echo U('page/index',array('name'=>'lxwm'));?>?l=zh-en">Contact Us   </a></p></li>
            <li><p><a href="?l=zh-cn">中文</a></p><p class="yw"><a href="?l=zh-cn">Chinese  </a></p></li>
            <li><p><a href="?l=zh-en">英文</a></p><p class="yw"><a href="?l=zh-en"> English</a></p></li>
            
            
        </ul>
    </div>
    <div class="cl"></div>
</div>


<style>
body {
	background: url(__ROOT__/Home/Tpl/default/Public/images/bg.jpg) no-repeat top center #eeeeee
}
</style>

<div class="fgyb">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listvo): $mod = ($i % 2 );++$i;?><div class="list_vv">
    <h2><?php echo ($listvo["update_time"]); ?></h2>
    <div class="list_nr"> <a href="<?php echo U('Regulations/read',array('id'=>$listvo[id]));?>" target="_blank">
      <p class="wzbt"><?php echo ($listvo["title"]); ?></p>
      <p class="wznr"><?php echo ($listvo["summary"]); ?></p>
      </a> </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>  
  <div class="cl"></div>
  <div class="pages"><?php echo ($page); ?></div>
</div>


<div class="footer">
	版权所有 © 锐驰莱德信息技术（北京）有限公司 　ICP:京ICP备13038052号<br />

地址：北京市海淀区安宁庄西路9号宜品上层一单元403室
</div>

<?php echo ($site["SITE_INFO"]["tongji"]); ?>



</body>
</html>
<div class="cenav"><a href="<?php echo U('Servicetype/index');?>">业务类型</a><a href="<?php echo U('Project/index');?>">项目管理</a><a href="<?php echo U('regulations/index');?>">法规月报</a><a href="<?php echo U('Lawssystem/index');?>">法规系统</a></div>