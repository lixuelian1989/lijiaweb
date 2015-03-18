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
  <div class="M"> <a href="<?php echo U('Index/index');?>">首页</a> <a href="">我要卖车</a> <a href="">我要置换</a> <a href="<?php echo U('news/index');?>" class="active">84资讯</a> <a href="">84分享</a> <a href="">团新车</a> </div>
</div>
<div class="Kong"></div>
<div class="zhaopin_maintitle">84招聘</div>
<div class="zhaopin_main">
  <div class="zhaopin_left">
    <ul>
      <li><a href="<?php echo U('Page/index',array('name'=>'lianxiwomen'));?>">联系我们</a></li>
      <li><a href="<?php echo U('Page/index',array('name'=>'hezuofangshi'));?>">合作方式</a></li>
      <li class="hover"><a href="<?php echo U('Zhaopin/index');?>">84招聘</a></li>
    </ul>
  </div>
  <div class="zhaopin_right"> <a href="#"><img src="__ROOT__/Home/Tpl/default/Public/images/zhaopin_banner1.jpg"/></a> <a href="#"><img src="__ROOT__/Home/Tpl/default/Public/images/zhaopin_banner1.jpg"/></a>
    <table width="682" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>职位</th>
        <th>类别</th>
        <th>招聘人数</th>
        <th>工作地点</th>
        <th>发布时间</th>
      </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><a href="<?php echo U('Zhaopin/read',array('id'=>$vo[id]));?>" target="_blank"><?php echo ($vo["name"]); ?></a></td>
        <td><a  href="<?php echo U('Zhaopin/read',array('id'=>$vo[id]));?>" target="_blank"><?php echo ($vo["leibie"]); ?></a></td>
        <td><a  href="<?php echo U('Zhaopin/read',array('id'=>$vo[id]));?>" target="_blank"><?php echo ($vo["peonum"]); ?></a></td>
        <td><a  href="<?php echo U('Zhaopin/read',array('id'=>$vo[id]));?>" target="_blank"><?php echo ($vo["address"]); ?></a></td>
        <td><a  href="<?php echo U('Zhaopin/read',array('id'=>$vo[id]));?>" target="_blank"><?php echo ($vo["adddate"]); ?></a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    
    <div class="page">
    	<?php echo ($page); ?>
    </div>
    
    
    <div class="lianxi_fs">
    联系方式
    </div>
    <div class="lianxi_txt">
    简历投递至：<?php echo ($site["SITE_INFO"]["service"]); ?>
    </div>    
    <div class="lianxi_txt">
    电话：<?php echo ($site["SITE_INFO"]["tel"]); ?>
    </div>        
    <div class="lianxi_txt">
    地址：<?php echo ($site["SITE_INFO"]["address"]); ?>
    </div>    
    <div class="ad">
    	<div class="ad_con">
	        <a href="#">
    	    	<img src="/Home/Tpl/default/Public/images/ad_44.jpg" alt=""/>
            </a>
        </div>
        <div class="ad_con">
	        <a href="#">
    	    	<img src="/Home/Tpl/default/Public/images/ad_44.jpg" alt=""/>
            </a>
        </div>
        <div class="ad_con">
	        <a href="#">
    	    	<img src="/Home/Tpl/default/Public/images/ad_44.jpg" alt=""/>
            </a>
        </div>
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