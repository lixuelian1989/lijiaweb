<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
    <meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">
   
    
    
    
    <link rel="stylesheet" href="__PUBLIC__/web/css/main.css" type="text/css" media=" screen"/>
<script type="text/javascript" src="__PUBLIC__/web/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/web/js/js.js"></script>
<script type="text/javascript">
$(function(){
//--------------------------------焦点图；	
    $(".main_pic .m_p").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 700
    });

})


</script>
    
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


<div class="main_pic">
	<ul class="m_p">
    	<li><a href="javascript:" ><img src="__PUBLIC__/web/images/index_08.jpg" /></a></li>
        <li><a href="javascript:"><img src="__PUBLIC__/web/images/index_08.jpg" /></a></li>
        <li><a href="javascript:"><img src="__PUBLIC__/web/images/index_08.jpg" /></a></li>
        <li><a href="javascript:"><img src="__PUBLIC__/web/images/index_08.jpg" /></a></li>
        <li><a href="javascript:"><img src="__PUBLIC__/web/images/index_08.jpg" /></a></li>
    </ul>
</div>
<div class="con">
	<div class="left">
    	<div class="div1">
        	<h3 class="title_l">餐饮美食</h3>
<div class="sub_con"  style="min-height:auto; margin:0;">
	<div class="hot" style="border:0; height:auto;">
    	<div class="div1" style="padding-bottom:0;">
        
            <ul class="ul2">
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
            	<li>
                	<a href="#"><p class="p1"><img src="__PUBLIC__/web/images/wm_14.png" /></p>                    <div class="rr">                    	<p class="a1">麻辣传奇</p>                        <p class="a2">中式</p>                        <p class="a2">30元起送 免费配送</p>                        <P class="a3"><img src="__PUBLIC__/web/images/wm_07.png" /><img src="__PUBLIC__/web/images/wm_09.png" /></P>                    </div></a>
                </li>
                
            </ul>
            
        </div>
	</div>
</div>
        </div>
    	<div class="div2">
        	<h3 class="title_l jiazheng">家政服务</h3>
            <P class="p1"><a href="家政 - 钟点工.html">搬家</a>&nbsp;&nbsp;|  &nbsp;&nbsp;<a href="#">钟点工</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">保洁</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">疏通</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">回收</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">生活配送</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">洗衣</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">礼品</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">租车</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">房屋维修</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">家电维修</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">手机维修</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">电脑维修</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">开锁换锁</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">空调维修</a>&nbsp;&nbsp; <a href="#">更多>></a></P>
            <ul class="ul2">
            	<li><img src="__PUBLIC__/web/images/index_43.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_47.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_49.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_55.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_56.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_57.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_58.jpg" /></li>
            	<li><img src="__PUBLIC__/web/images/index_63.jpg" /></li>
                
            </ul>
        </div>

    	<div class="div3">
        	<h3 class="title_l qiuzhi">求职招聘</h3>
            <P class="p1"><span><a href="#">热门招聘</a></span>&nbsp;&nbsp;  &nbsp;&nbsp;<a href="#">名企在线</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">兼职招聘</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">延庆招聘会</a>&nbsp;&nbsp; <a href="#">更多>></a></P>
            <P class="p2">
                <a href="招聘求职-职位列表页.html">销售</a><a href="#">客服</a><a href="#">司机</a><a href="#">营业员</a><a href="#">文员</a><a href="#">普工</a><a href="#">焊工</a><span class="span1"><a href="#">理货员</a></span><a href="#">收银员</a><a href="#">电工</a><a href="#">编辑</a><a href="#">导购员</a><a href="#">网管</a><a href="#">保安</a><a href="#">出纳</a><a href="#">幼教</a><a href="#">木工</a><a href="#">教师</a><a href="#">厨师</a><a href="#">会计</a><a href="#">保洁</a><a href="#">医生</a><a href="#">服务员</a><a href="#">护士</a><a href="#">翻译</a><a href="#">保姆</a><a href="#">库管</a><a href="#">配菜</a><a href="#">网编</a><a href="#">快递员</a><a href="#">学徒</a><a href="#">杂工</a><a href="#">搬运工</a><span class="span1"><a href="#">家政</a></span><a href="#">导游</a><a href="#">房产</a><a href="#">行政/后勤</a><a href="#">人事专员</a><a href="#">保险</a><a href="#">洗车工</a><a href="#">面点师</a><a href="#">钟点工</a><a href="#">平面设计</a><a href="#">网页设计</a><a href="#">装潢设计</a><a href="#">足疗师</a><a href="#">发型师</a><a href="#">化妆师</a><a href="#">大堂经理</a><a href="#">防损员</a><a href="#">送餐员</a><a href="#">理赔专员</a><a href="#">汽车美容</a><span class="span2"><a href="#">更多职位>></a></span>
            	
            </P>             

        </div>
        
    </div>
    <div class="right">
    	<div class="div1">
        	<h3 class="title_r">房产<a href="#">more</a></h3>
            <div class="div11">
            	<img src="__PUBLIC__/web/images/index_11.jpg" />
                <P><span class="span1"><a href="房产.html">二手房</a></span>    <a href="#">新房</a>    <a href="#">出租</a>    <a href="#">合租</a>    <a href="#">求租</a>
<a href="#">商铺</a>    <a href="#">写字楼</a>    <a href="#">抵押</a>    <span  class="span2"><a href="#">更多>></a></span></P>
            </div>
        </div>
        
    	<div class="div2">
        	<h3 class="title_r">车辆<a href="#">more</a></h3>
            <div class="div11">
            	<img src="__PUBLIC__/web/images/index_27.jpg" />
                <P><a href="车辆.html">二手车            
</a>    <a href="#">准新车</a>    <a href="#">二手车贷款</a>    <a href="#">抵押</a>    <span class="span2"><a href="#">更多>></a></span></P>
            </div>
        </div>

    	<div class="div3">
        	<h3 class="title_r">旅游订票</h3>
            <a href="旅游订票-预订页.html"><img src="__PUBLIC__/web/images/index_40.jpg" /></a>
        </div>
        
    	<div class="div4">
        	<h3 class="title_r">酒店住宿</h3>
            <a href="酒店住宿.html"><img src="__PUBLIC__/web/images/index_60.jpg" /></a>
        </div>
        
    	<div class="div5">
        	<P class="p1">同城交友</P>
            <div class="div51">
            	<P>我刚通过利嘉商圈定了外卖，很快就
送到了~满意！ 11-12 </P>
                <P class="p1">我刚通过利嘉商圈找了保洁阿姨，利
嘉商圈真的很方便，点赞~.  11-12 </P>
            </div>
            <P class="p2"><a href="#">查看更多>></a></P>
        </div>
        
    </div>
</div>


<div class="footer">
	<P class="p1"><a href="底部信息-联系我们.html">联系我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="底部信息-服务声明.html">服务声明</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="底部信息-加入我们.html">加入利嘉</a></P>	
    <p class="p2">客户服务热线:18600602220&nbsp;&nbsp;&nbsp;&nbsp; 销售热线：400-60165681&nbsp;&nbsp;&nbsp;&nbsp; 商务邮箱：business@lijia.com</p>
    <p class="p3">地址:北京市延庆县庆园街82号院17-3&nbsp;&nbsp;&nbsp;&nbsp; copyright 2014-2020&nbsp;&nbsp;&nbsp;&nbsp;北京利嘉投资管理有限公司</p>

</div>
</body>
</html>