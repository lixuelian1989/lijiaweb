<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <meta name="keywords" content="<?php if($info['keywords']){ echo ($info['keywords']); }else{ echo ($webtitle); ?>,<?php echo ($site["SITE_INFO"]["keyword"]); } ?>">
    <meta name="description" content="<?php if($info['description']){ echo ($info['description']); }else{ echo ($webtitle); ?>-<?php echo ($site["SITE_INFO"]["description"]); } ?>">
    <link rel="stylesheet" type="text/css" href="__ROOT__/Home/Tpl/default/Public/css/public.css" />
<script type="text/javascript" src="__ROOT__/Home/Tpl/default/Public/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__ROOT__/Home/Tpl/default/Public/js/koala.min.1.5.js"></script>
<script type="text/javascript" src="__ROOT__/Home/Tpl/default/Public/js/jquery.js"></script>
</head>

<body>

<div class="topnav">
<?php if($uinfo): echo ($uinfo["uname"]); ?>欢迎您,登陆 法规系统 &nbsp;|&nbsp;<a href="<?php echo U('User/info');?>">个人中心</a>&nbsp;|&nbsp;
<a href="<?php echo U('User/loginOut');?>">退出</a>
<?php else: ?>
<a href="<?php echo U('User/index');?>">登陆</a>&nbsp;|&nbsp;<a href="<?php echo U('User/regist');?>">注册</a><?php endif; ?>

&nbsp;|&nbsp;<a href="?l=zh-cn">中文</a>&nbsp;|&nbsp;<a href="?l=zh-en">英文</a></div>
<div class="top">
	<div class="logobox l"><a href="<?php echo U('index/index');?>"><img src="__ROOT__/Home/Tpl/default/Public/images/logo.png" /></a></div>	
    <div class="navbox r" style=" width:719px;">
    	<ul>
        	<li><p><a href="<?php echo U('index/index');?>">首页</a></p></li>
            <li><p><a href="">最近更新  </a></p></li>
            <li><p><a href="">收藏夹</a></p></li>
            <li><p><a href="">搜索</a></p></li>
            <li><p><a href="">帮助</a></p></li>
            <li><p><a href="">帮助</a></p></li>
            <li><p><a href="">个人中心</a></p></li>
           
        </ul>
    </div>
    <div class="cl"></div>
</div>
<style>
body {	background: url(__ROOT__/Home/Tpl/default/Public/images/bg.jpg) no-repeat top center #eeeeee}
</style>


<div class="fgzc">
	<div class="fgbanner">
	  <div id="fsD1" class="focus" >
	    <div id="D1pic1" class="fPic">
        
	      <div class="fcon" style="display: none;">
          	 <a target="_blank" href="#"><img src="__ROOT__/Home/Tpl/default/Public/images/01.jpg" style="opacity: 1; " /></a>
           	<span class="shadow"><a target="_blank" href="#">banner说明文字</a></span>
          </div>
	      <div class="fcon" style="display: none;"> 
          	<a target="_blank" href="#"><img src="__ROOT__/Home/Tpl/default/Public/images/02.jpg" style="opacity: 1; " /></a>
             <span class="shadow"><a target="_blank" href="#">banner说明文字</a></span>
          </div>
	      <div class="fcon" style="display: none;"> 
           	<a target="_blank" href="#"><img src="__ROOT__/Home/Tpl/default/Public/images/03.jpg" style="opacity: 1; " /></a>
             <span class="shadow"><a target="_blank" href="#">banner说明文字</a></span>
           </div>
	      <div class="fcon" style="display: none;">
           	 <a target="_blank" href="#"><img src="__ROOT__/Home/Tpl/default/Public/images/04.jpg" style="opacity: 1; " /></a>
             <span class="shadow"><a target="_blank" href="#">banner说明文字</a></span> 
         </div>
        </div>
	    <div class="fbg">
	      <div class="D1fBt" id="D1fBt"> 
          	<a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>1</i></a>
            <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>2</i></a> 
            <a href="javascript:void(0)" hidefocus="true" target="_self" class="current"><i>3</i></a>
            <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>4</i></a> </div>
        </div>
	    <span class="prev"></span> <span class="next"></span> </div>
        
        <script type="text/javascript">
	Qfast.add('widgets', { path: "__ROOT__/Home/Tpl/default/Public/js/terminator2.2.min.js", type: "js", requires: ['fx'] });  
	Qfast(false, 'widgets', function () {
		K.tabs({
			id: 'fsD1',   //焦点图包裹id  
			conId: "D1pic1",  //** 大图域包裹id  
			tabId:"D1fBt",  
			tabTn:"a",
			conCn: '.fcon', //** 大图域配置class       
			auto: 1,   //自动播放 1或0
			effect: 'fade',   //效果配置
			eType: 'click', //** 鼠标事件
			pageBt:true,//是否有按钮切换页码
			bns: ['.prev', '.next'],//** 前后按钮配置class                          
			interval: 3000  //** 停顿时间  
		}) 
	})  
</script>
	</div>
   
    
    <div class="han_main">
    	<div class="han_left l">
  <div class="tjsx">条件筛选</div>
  <script>
							$(document).ready(function(){
							$(".title22").click(function(){
							var o=$(this);
							o.parent().find(".content44").slideUp(200);
							o.next().slideDown(300);
							//$(".content").eq(index).slideDown(300);
							});
							});
							</script>
  <h3   class="title22">颁布国家</h3>
  <div class="content44" style="display:none">
    <table width="">
      <?php if(is_array($lc_list)): $i = 0; $__LIST__ = $lc_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><input type="checkbox" name="lc_id[]" value="<?php echo ($vo["lc_id"]); ?>" /></td>
        <td>
        <img src="<?php echo ($vo["lc_img"]); ?>" width="42" height="42" />
        </td>
        <td><?php echo (msubstr($vo["lc_name"],0,18,'utf-8',false)); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div>
  <h3  class="title22">法规类型</h3>
  <div class="content44" style="display:none">
    
    <?php echo ($fglx_str); ?>
    
  </div>
  <h3  class="title22">车       型</h3>
  <div class="content44" style="display:none">
    <?php echo ($lm_str); ?>
  </div>
  <h3  class="title22">法规状态</h3>
  <div class="content44" style="display:none">
    <table>
      <tr>
        <td style="text-align:right"><input type="checkbox" name="lt_status[]" value="1" /></td>
        <td style="text-align:left">生效</td>
        <td style="text-align:right"><input type="checkbox" name="lt_status[]" value="2" /></td>
        <td style="text-align:left">草案</td>
      </tr>
    </table>
  </div>
  <h3  class="title22">生效日期</h3>
  <div class="content44" style="display:none">
    <table>
      <tr>
        <td >从
          <select>
            <option>2014年</option>
            <option>2013年</option>
            <option>2012年</option>
          </select>
          <select>
            <option>7月</option>
            <option>7月</option>
            <option>7月</option>
          </select>
          <select>
            <option>7日</option>
            <option>7日</option>
            <option>7日</option>
          </select></td>
      </tr>
      <tr>
        <td >到
          <select>
            <option>2014年</option>
            <option>2013年</option>
            <option>2012年</option>
          </select>
          <select>
            <option>7月</option>
            <option>7月</option>
            <option>7月</option>
          </select>
          <select>
            <option>7日</option>
            <option>7日</option>
            <option>7日</option>
          </select></td>
      </tr>
    </table>
  </div>
  <div class="tjsx">收藏夹</div>
  <div class="scj">
    <li>喜欢的网站或网址</li>
    <li>图书分类</li>
  </div>
  <div class="tjsx">收藏夹</div>
  <div class="scj">
    <li>2007 / 46 / EC指令号</li>
    <li> 法规（EC）661号/ 2009 </li>
    <li>法规（EC）715号/ 2007 </li>
    <li>71 / 320 / EEC指令号</li>
    <li> 法规（EC）595号</li>
  </div>
</div>
        
        
        <div class="han_right r">
        	<div  class="serchbox">
        	  <input class="tex" type="text" />
        	  <input class="bt" type="button" />
          </div>
            <div class="right_nr">
  <ul class="bbgg">
                	<?php if(is_array($lc_list)): $i = 0; $__LIST__ = $lc_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a title="<?php echo ($vo["lc_name"]); ?>" href="<?php echo ($vo["lc_id"]); ?>" target="_blank"><img src="<?php echo ($vo["lc_img"]); ?>" width="90" height="90" /><p><?php echo (msubstr($vo["lc_name"],0,18,'utf-8',false)); ?></p></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="cl"></div>
    </div>
    
     <div class="bottombanner"><img src="__ROOT__/Home/Tpl/default/Public/images/03.jpg" /></div>
</div>




<div class="footer">
	版权所有 © 锐驰莱德信息技术（北京）有限公司 　ICP:京ICP备13038052号<br />

地址：北京市海淀区安宁庄西路9号宜品上层一单元403室
</div>

<?php echo ($site["SITE_INFO"]["tongji"]); ?>



</body>
</html>
<div class="cenav"><a href="<?php echo U('Servicetype/index');?>">业务类型</a><a href="<?php echo U('Project/index');?>">项目管理</a><a href="<?php echo U('regulations/index');?>">法规月报</a><a href="<?php echo U('Lawssystem/index');?>">法规系统</a></div>
</body>