<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>生成模版标签-网站设置-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <?php $addCss=""; $addJs=""; $currentNav ='网站设置 > 生成模版标签'; ?>
    <base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<link rel="stylesheet" type="text/css" href="../Public/Css/base.css" />
<link rel="stylesheet" type="text/css" href="../Public/Css/layout.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.lazyload.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/functions.js"></script>
<script type="text/javascript" src="../Public/Js/base.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/asyncbox/asyncbox.js<?php echo ($addJs); ?>"></script>
</head>
<body>
<div class="wrap"> <div id="Top">
    <div class="logo"><a href="<?php echo ($site["WEB_ROOT"]); ?>"><img src="../Public/Img/logo.png" style="border: 0" /></a></div>
    <div class="help"><a href="<?php echo U('Index/simplemap');?>">后台地图</a><span><a href="http://www.conist.com" target="_blank">关于</a></span></div>
    <div class="menu">
        <ul> <?php echo ($menu); ?> </ul>
    </div>
</div>
<div id="Tags">
    <div class="userPhoto"><img src="../Public/Img/userPhoto.png" /> </div>
    <div class="navArea">
        <div class="userInfo"><div><a href="<?php echo U('Webinfo/index');?>" class="sysSet"><span>&nbsp;</span>系统设置</a> <a href="<?php echo U("Public/loginOut");?>" class="loginOut"><span>&nbsp;</span>退出系统</a></div>欢迎您，<?php echo ($my_info["email"]); ?> | <a target="_blank" href="<?php echo C('SITE_INFO.url');?>">网站首页</a></div>
        <div class="nav"><font id="today"><?php echo date("Y-m-d H:i:s"); ?></font>您的位置：<?php echo ($currentNav); ?></div>
    </div>
</div>
<div class="clear"></div>
    <div class="mainBody"> <div id="Left">
    <div id="control" class=""></div>
    <div class="subMenuList">
        <div class="itemTitle"><?php if(MODULE_NAME == 'Index'): ?>常用操作<?php else: ?>子菜单<?php endif; ?> </div>
        <ul>
            <?php if(is_array($sub_menu)): foreach($sub_menu as $key=>$sv): ?><li><a href="<?php echo ($sv["url"]); ?>"><?php echo ($sv["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
    <?php if(C('QRCODE')){ ?><div class="QRcode">移动设备访问本页：<br/><br/><img src="<?php echo ($QRcodeUrl); ?>"/></div><?php } ?>
</div>
        <div id="Right">
            <div class="contentArea">
                <div class="Item hr">
                    <div class="current">生成模版标签</div>
                </div>
                <form>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                        <tr>
                            <th>列表内容：</th>
                            <td><select name="list_type" onchange="selectCat(this.value)" style="width: 80px;">
                                <option value="n">文章列表</option>
                                <option value="p">产品列表</option>
                            </select></td>
                        </tr>
                        <tr>
                            <th>内容类目：</th>
                            <td><select id="content_type" name="content_type" style="width: 80px;">
                                <option value="">全部</option>
                                <?php if(is_array($newcat)): $i = 0; $__LIST__ = $newcat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["fullname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select></td>
                        </tr>
                        <tr>
                            <th width="120">显示条数：</th>
                            <td><input name="limit" type="text" class="input" size="20" value="5" /> </td>
                        </tr>
                        <tr>
                            <th>类型：</th>
                            <td><select name="type" style="width: 140px;">
                                <option value="id">最新</option>
                                <option value="click">最热</option>
                                <option value="is_recommend">推荐</option>
                            </select></td>
                        </tr>
                        <tr>
                            <th>排序：</th>
                            <td><select name="order" style="width: 140px;">
                                <option value="DESC">倒序</option>
                                <option value="ASC">顺序</option>
                            </select></td>
                        </tr>
                        <tr>
                            <th>代码：</th>
                            <td><textarea style="width: 400px;height: 100px;" readonly id="returntext"></textarea></td>
                        </tr>
                        <tr>
                            <th>变量解析：</th>
                            <td><literal>
                                <p>可在对应的标签内使用：</p>
                                <p>文章：文章ID<?php echo ($new["id"]); ?>,文章标题<?php echo ($new["title"]); ?>,文章分类ID<?php echo ($new["cid"]); ?>,添加时间<?php echo ($new["published"]); ?>,更新时间<?php echo ($new["update_time"]); ?>,摘要<?php echo ($new["summary"]); ?></p>
                                <p>产品：产品ID<?php echo ($pro["id"]); ?>,产品标题<?php echo ($pro["title"]); ?>,产品分类ID<?php echo ($pro["cid"]); ?>,添加时间<?php echo ($pro["published"]); ?>,更新时间<?php echo ($pro["update_time"]); ?>,摘要<?php echo ($pro["summary"]); ?>,图片<?php echo ($pro["image"]); ?></p>
                            </literal></td>
                        </tr>
                    </table>
                </form>
                <div class="commonBtnArea" >
                    <button class="btn submit">生成</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $(window).resize(autoSize);
    $(function(){
        autoSize();
        $(".loginOut").click(function(){
            var url=$(this).attr("href");
            popup.confirm('你确定要退出吗？','你确定要退出吗',function(action){
                if(action == 'ok'){ window.location=url; }
            });
            return false;
        });

        var time=self.setInterval(function(){$("#today").html(date("Y-m-d H:i:s"));},1000);


    });
</script>
<script type="text/javascript">
    $(function(){
        $(".submit").click(function(){
                var formObj="form";
                var url=document.URL;
            $(formObj).ajaxSubmit({
                url:url,
                type:"POST",
                success:function(data, st) {
                    if(data.status==1){
                        $('#returntext').val(data.info);
                    }
                }
            });
            return false;
        });
    });
    function selectCat(v){
        $.get('<?php echo U("Siteinfo/selectCat");?>?t='+v,function(data){
            $('#content_type').html(data.info);
        });
    }
</script>
</body>
</html>