<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>站点配置-系统设置-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <?php $addCss=""; ?>
    <?php $addJs=""; ?>
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
                        <div class="current">站点配置</div>
                    </div>
                    <form action="" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th width="120">站点名称：</th>
                                <td><input name="name" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["name"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th width="120">站点地址：</th>
                                <td><input name="url" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["url"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th width="120">网站版本：</th>
                                <td><input name="version" type="text" class="input" size="40" value="<?php echo ($site["SITE_INFO"]["version"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>ICP备案：</th>
                                <td><input class="input" name="icp" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["icp"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>客服邮箱：</th>
                                <td><input class="input" name="service" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["service"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>客服电话：</th>
                                <td><input class="input" name="tel" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["tel"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>传真号码：</th>
                                <td><input class="input" name="fax" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["fax"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>QQ号码：</th>
                                <td><input class="input" name="qq" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["qq"]); ?>" /></td>
                            </tr>
                            
                            <tr>
                                <th>上班时间：</th>
                                <td><input class="input" name="sp_time" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["sp_time"]); ?>" /></td>
                            </tr>
                            
                            <tr>
                                <th>地图文件地址：</th>
                                <td>
                                
                                <input class="input" name="map_address" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["map_address"]); ?>" />
                                
                                </td>
                            </tr>
                            <tr>
                                <th>公司地址：</th>
                                <td><input class="input" name="address" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["address"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>邮政编码：</th>
                                <td><input class="input" name="postcode" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["postcode"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>网站关键字：</th>
                                <td><input class="input" name="keyword" type="text" size="40" value="<?php echo ($site["SITE_INFO"]["keyword"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>开启多语言：</th>
                                <td><label style="margin-right: 10px;"><input type="radio" name="LANG_SWITCH_ON" <?php if($site['SITE_INFO']['LANG_SWITCH_ON'] == 1): ?>checked<?php endif; ?> value="1">开启</label><label><input type="radio"  <?php if($site['SITE_INFO']['LANG_SWITCH_ON'] == 0): ?>checked<?php endif; ?>  name="LANG_SWITCH_ON" value="0">关闭</label></td>
                            </tr>
                            <tr>
                                <th>网站公告：</th>
                                <td><textarea name="notice" cols="80" rows="3"><?php echo ($site["SITE_INFO"]["notice"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th>网站简介：</th>
                                <td><textarea name="description" cols="80" rows="3"><?php echo ($site["SITE_INFO"]["description"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th>统计代码：</th>
                                <td><textarea name="tongji" cols="80" rows="3"><?php echo ($site["SITE_INFO"]["tongji"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th>分享代码：</th>
                                <td><textarea name="fenxiang" cols="80" rows="3"><?php echo ($site["SITE_INFO"]["fenxiang"]); ?></textarea></td>
                            </tr>
                        </table>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
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
    $(".submit").click(function(){
        commonAjaxSubmit();
    });
</script>
</body>
</html>