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

<div class="dhhav"> <a href="#gsjs">公司介绍 </a> —— <a href="#hzhb">合作伙伴</a> —— <a href="#smyj">使命愿景</a> </div>
<div class="gsjj">
	<a id="gsjs"></a>
  <div class="gstt">
    <div class="gsmid">公司介绍</div>
  </div>
  <div class="jrmid">
   <?php echo ($info['content']); ?>
  </div>
</div>
<div class="gstt">
<a id="smyj"></a>
  <div class="gsmid">使命愿景</div>
</div>
<div style="background:#FFF">
  <div class="jrmid" style="text-align:center; padding:50px 0px; background:#FFF"><img src="__ROOT__/Home/Tpl/default/Public/images/zy_07.png" /></div>
</div>
<div class="gsjj hezhb">
<a id="hzhb"></a>
  <div class="gstt">
    <div class="gsmid">合作伙伴</div>
  </div>
  <div class="jrmid ">
    <div class="gshhnr"> <img src="__ROOT__/Home/Tpl/default/Public/images/gywm1.png" />
      <p>成立于1992年，在整车及零部件的全球分销体系的建立上，其管理团队拥有丰富的实战经验。专业致力于美中国际汽车厂商到中南美洲（如美国、墨西哥、巴西）等地合资建厂，并为其建立有效的质量管理体系，打造符合市场预期的完美产品。<br />
        Founded since 1992.  Its executive team has abundant proven experience in the delivery of systems and vehicles intended for global distribution.Expertise in the planning of international automotive manufacturing joint ventures from US, China to North, Central and South America, like US, Mexico, Brazil, etc, and establishment of best practice corporate quality management systems to ensure durable quality to meet the markets’ needs. </p>
    </div>
    <div class="gshhnr" style="font-family:'宋体'"> <img src="__ROOT__/Home/Tpl/default/Public/images/gywm_06.png" />
      <p>CETOC成立于1980年，该中心奠基人 – Luciano Rossi – 自1963年就开始在工业机动车认证，测试盒认证服务方面展开运作。CETOC在汽车领域内技术与机构咨询服务经验丰富，成绩斐然，并为龙头企业提供高标准服务。现在，CETOC在技术咨询和技术活动领域成为客户群体的标榜机构。许多外国公司在欧洲市场都引入该中心服务产品，并以其作为模范服务中心和官方进口商。<br />
        CETOC was established in 1980, but the founder – Luciano Rossi – has been opeating since 1963 in the fields of homologation, testing and the approvals of industrial vehicles.Cetoc takes pride in its vast experience in technical and organizational consultancy within the automotive sector and provides high standards of service to leading companies. Today CETOC is a reference orfanization fro its customers for consultancy and technical activities. Many foreign companies, looking to introduce in the Eurpean market their products, consider CETOC as a good support, as well as their official importers. </p>
    </div>
  </div>
</div>
<div class="gstt">
  <div class="gsmid">服务机构</div>
</div>
<div class="jrmid" style="text-align:center; padding:50px 0px;"><img src="__ROOT__/Home/Tpl/default/Public/images/w_03.jpg" /></div>
<div class="gsjj">
  <div class="gstt">
    <div class="gsmid">服务客户</div>
  </div>
  <div class="jrmid">
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_09.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_11.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_13.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_15.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_21.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_22.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_23.jpg" /></div>
    <div class="hebox"><img src="__ROOT__/Home/Tpl/default/Public/images/keh_24.jpg" /></div>
    <div class="cl"></div>
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