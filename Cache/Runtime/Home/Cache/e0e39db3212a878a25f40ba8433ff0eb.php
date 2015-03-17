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
<div class="ad"></div>
<div class="logo">
	<h3><a href="#"><img src="__PUBLIC__/web/images/index_07.png" /></a></h3>
    <div class="right">
        <div class="ser">
            <input class="txt" type="text" value="100%家政服务" /><input class="sub" type="submit" value="延庆搜索" />
            <input class="sub2" type="submit" value="免费发布信息"/>
            <P class="hot_ser">热门搜索：    <a href="#">订餐</a>    <a href="#">团购门票</a>    <a href="#">钟点工</a>    <a href="#">洗衣</a>    <a href="#">酒店预定</a>    <a href="#">租房</a>    <a href="#">求职</a></P>
        </div>
    </div>
</div>
<div class="nav">
	<ul class="nav_ul">
    	<li class="cur1"><a href="index.html">首页</a></li>
        <li><a href="外卖跑腿.html">餐饮美食</a></li>
        <li><a href="房产.html">房产</a></li>
        <li><a href="家政.html">家政服务</a></li>
        <li><a href="车辆.html">车辆</a></li>
        <li><a href="酒店住宿.html">酒店住宿</a></li>
        <li><a href="旅游订票.html">旅游门票</a></li>
        <li><a href="求职招聘.html">求职招聘</a></li>
        <li><a href="投资咨询.html">投资咨询</a></li>
        <li><a href="#">交友</a></li>
    </ul>
</div>
<div class="Head_nav">
  <div class="M"> <a href="<?php echo U('Index/index');?>">首页</a> <a href="">我要卖车</a> <a href="">我要置换</a> <a href="<?php echo U('news/index');?>" class="active">84资讯</a> <a href="">84分享</a> <a href="">团新车</a> </div>
</div>
<div class="Kong"></div>
<div class="zhaopin_maintitle">联系我们</div>
<div class="zhaopin_main">
  <div class="zhaopin_left">
    <ul>
      <li class="hover"><a href="<?php echo U('Page/index',array('name'=>'lianxiwomen'));?>">联系我们</a></li>
      <li><a href="<?php echo U('Page/index',array('name'=>'hezuofangshi'));?>">合作方式</a></li>
      <li><a href="<?php echo U('Zhaopin/index');?>">84招聘</a></li>
    </ul>
  </div>
  <div class="zhaopin_right">
    <div class="lxwm_title">官方客服</div>
    <div class="lxwm_content">
      <div class="lxwm_dianhua"><?php echo ($site["SITE_INFO"]["tel"]); ?></div>
      <div class="lxwm_youjian"><?php echo ($site["SITE_INFO"]["service"]); ?></div>
      <div class="clear"></div>
    </div>
    <div class="lxwm_content line">
      <div class="gongzuo">工作时间：<?php echo ($site["SITE_INFO"]["sp_time"]); ?></div>
    </div>
    <div class="lxwm_title mar-top30">公司地址</div>
    <div class="lxwm_content">
      <div class="dizhi">84租车</div>
      <div class="dizhi_text"><?php echo ($site["SITE_INFO"]["address"]); ?></div>
 
        <!--地图 start--> 
        <!--<img src="__ROOT__/Home/Tpl/default/Public/images/ditu.jpg"/>-->
        <div class="dtright"> 
          
          <!--引用百度地图API-->
          <style type="text/css">
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
          <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script> 
          
          <!--百度地图容器-->
          <div  class="map_ditu" id="dituContent"></div>
          <script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(116.395645,39.929986);//定义一个中心点坐标
        map.centerAndZoom(point,12);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    
    initMap();//创建和初始化地图
</script> 
        
        
        <!--地图 end--> 
      </div>
    </div>
    <div class="lxwm_content line"> </div>
    <div class="lxwm_title mar-bot30 mar-top30">公司简介</div>
    <div class="jianjie">
      <div class="left">
        <div class="img"> </div>
      </div>
      <div class="right"> <?php echo ($info["content"]); ?> </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div class="Kong"></div>
<div class="footer">
	<P class="p1"><a href="底部信息-联系我们.html">联系我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="底部信息-服务声明.html">服务声明</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="底部信息-加入我们.html">加入利嘉</a></P>	
    <p class="p2">客户服务热线:18600602220&nbsp;&nbsp;&nbsp;&nbsp; 销售热线：400-60165681&nbsp;&nbsp;&nbsp;&nbsp; 商务邮箱：business@lijia.com</p>
    <p class="p3">地址:北京市延庆县庆园街82号院17-3&nbsp;&nbsp;&nbsp;&nbsp; copyright 2014-2020&nbsp;&nbsp;&nbsp;&nbsp;北京利嘉投资管理有限公司</p>

</div>
</body>
</html>