<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
    <meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">

<link href="__ROOT__/Home/Tpl/default/Public/css/public.css" rel="stylesheet" />
<link href="__ROOT__/Home/Tpl/default/Public/css/style.css" rel="stylesheet" />

    
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
    <div class="M">
        <a href="<?php echo U('Index/index');?>">首页</a>
        <a href="">我要卖车</a>
        <a href="">我要置换</a>
        <a href="<?php echo U('news/index');?>" class="active">84资讯</a>
        <a href="">84分享</a>
        <a href="">团新车</a>
    </div>
</div>


<div class="Head_nav_xia">
	<a href="<?php echo U('news/index');?>">84资讯  ></a>
</div>

<div class="Kong"></div>
<div class="M Replacement_advertis">
	<img src="__ROOT__/Home/Tpl/default/Public/images/zc_img17.jpg" />
</div>
<div class="Kong"></div>
<div class="Kong"></div>

<div class="M Information_list">
	<div class="Infor_list l">
		<div class="Infor_list_title">
        	<a href="<?php echo U('News/newslist',array('cid'=>1));?>">MORE</a>
            <h2>84PAI动态</h2>
        </div>
        <ul class="Infor_ul">
        	<?php if(is_array($newlist1)): $i = 0; $__LIST__ = $newlist1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('News/read',array('id'=>$vo[id]));?>" target="_blank" title="<?php echo ($vo["title"]); ?>"><?php echo (cn_substr($vo["title"],0,27)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
	</div>
    <div class="Infor_list r">
		<div class="Infor_list_title">
        	<a href="<?php echo U('News/newslist',array('cid'=>2));?>">MORE</a>
            <h2>行业新闻	</h2>
        </div>
        <ul class="Infor_ul">
        	<?php if(is_array($newlist2)): $i = 0; $__LIST__ = $newlist2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('News/read',array('id'=>$vo[id]));?>" target="_blank" title="<?php echo ($vo["title"]); ?>"><?php echo (cn_substr($vo["title"],0,27)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
	</div>
    <div class="Infor_list l">
		<div class="Infor_list_title">
        	<a href="<?php echo U('News/newslist',array('cid'=>3));?>">MORE</a>
            <h2>84关爱</h2>
        </div>
        <ul class="Infor_ul">
        	<?php if(is_array($newlist3)): $i = 0; $__LIST__ = $newlist3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('News/read',array('id'=>$vo[id]));?>" target="_blank" title="<?php echo ($vo["title"]); ?>"><?php echo (cn_substr($vo["title"],0,27)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
	</div>
    <div class="Infor_list r">
		<div class="Infor_list_title">
        	<a href="<?php echo U('News/newslist',array('cid'=>4));?>">MORE</a>
            <h2>专题活动	</h2>
        </div>
        <ul class="Infor_ul">
        	<?php if(is_array($newlist4)): $i = 0; $__LIST__ = $newlist4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('News/read',array('id'=>$vo[id]));?>" target="_blank" title="<?php echo ($vo["title"]); ?>"><?php echo (cn_substr($vo["title"],0,27)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
	</div>
</div>


<div class="M Replacement_advertis">
	<img src="__ROOT__/Home/Tpl/default/Public/images/zc_img31.jpg" />
</div>
<div class="Kong"></div>
<div class="Kong"></div>
<div class="Kong"></div>







<div class="footer">
	<P class="p1"><a href="底部信息-联系我们.html">联系我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="底部信息-服务声明.html">服务声明</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="底部信息-加入我们.html">加入利嘉</a></P>	
    <p class="p2">客户服务热线:18600602220&nbsp;&nbsp;&nbsp;&nbsp; 销售热线：400-60165681&nbsp;&nbsp;&nbsp;&nbsp; 商务邮箱：business@lijia.com</p>
    <p class="p3">地址:北京市延庆县庆园街82号院17-3&nbsp;&nbsp;&nbsp;&nbsp; copyright 2014-2020&nbsp;&nbsp;&nbsp;&nbsp;北京利嘉投资管理有限公司</p>

</div>
</body>
</html>