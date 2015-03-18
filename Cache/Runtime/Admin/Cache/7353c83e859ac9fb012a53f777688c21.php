<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>留言管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <?php $addCss=""; $addJs=""; $currentNav ='留言管理 > 留言列表'; ?>
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
<div class="wrap">
    <div id="Top">
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
    <div class="mainBody">
        <div id="Left">
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
            <div class="Item hr">
                <div class="current">留言列表</div>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>姓名</td>
                    <td>邮箱</td>
                    <td>留言时间</td>
                    <td width="300">留言信息</td>
                    <td width="150">审核/删除</td>
                </tr>
                </thead>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="<?php echo ($vo["id"]); ?>">
                        <td align="left"><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["username"]); ?></td>
                        <td><?php echo ($vo["email"]); ?><br /><?php echo ($vo["moblie"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
                        <td><?php echo ($vo["content"]); ?></td>
                        <td><a title="审核状态" href="javascript:void(0);" onclick="changeStatus(<?php echo ($vo["id"]); ?>,this)"><img src="../Public/Img/action_<?php echo ($vo["display"]); ?>.png" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a link="<?php echo U('Siteinfo/delmessage/',array('id'=>$vo['id']));?>" href="javascript:void(0)" name="<?php echo ($vo["id"]); ?>" class="del"><img src="../Public/Img/action_remove.png" border="0"></a> </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr><td colspan="7" align="right"><?php echo ($page); ?></td></td></tr>
            </table>
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
        $(".del").click(function(){
            var delLink=$(this).attr("link"),$this = $(this);
            popup.confirm('你真的打算删除【<b>'+$(this).attr("name")+'</b>】吗?','温馨提示',function(action){
                if(action == 'ok'){
                    delByLink(delLink,$this);
                }
            });
            return false;
        });
    });
    function changeStatus(id,v){
        $.get('<?php echo U("Siteinfo/changeMessageStatus");?>?id='+id,function(data){
            if(data.status==1){
                $(v).html(data.info);
            }
        });
    }
</script>
</body>
</html>