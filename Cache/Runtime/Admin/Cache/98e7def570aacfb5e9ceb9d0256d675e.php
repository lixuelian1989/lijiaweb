<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加管理员-权限管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='权限管理 > 添加管理员'; ?>
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
                        <div class="current">添加管理员</div>
                    </div>
                    <form action="" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                            <tr>
                                <th width="120">账号邮件地址：</th>
                                <td><input <?php if(ACTION_NAME == 'editAdmin'): ?>disabled="disabled"<?php endif; ?> name="email" type="text" class="input" size="40" value="<?php echo ($info["email"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>新密码：</th>
                                <td><input class="input" name="pwd" type="password" size="40" value="" /></td>
                            </tr>
                            <tr>
                                <th>状态：</th>
                                <td>
                                    <select name="status" style="width: 80px;">
                                        <?php if($info["status"] == 1): ?><option value="1" selected>启用</option>
                                            <option value="0">禁用</option>
                                            <?php else: ?>
                                            <option value="1">启用</option>
                                            <option value="0" selected>禁用</option><?php endif; ?>
                                    </select>
                                    如果禁用了将无法登陆本系统</td>
                            </tr>
                            <tr>
                                <th>所属用户组</th>
                                <td><select name="role_id" style="min-width: 80px;"><?php echo ($info["roleOption"]); ?></select></td>
                            </tr>
                            <tr>
                                <th>备注：</th>
                                <td><textarea name="remark" rows="5" cols="57"><?php echo ($info["remark"]); ?></textarea></td>
                            </tr>
                        </table>
                        <input type="hidden" name="aid" value="<?php echo ($info["aid"]); ?>"/>
                    </form>
                    <div class="commonBtnArea">
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
            <?php if(ACTION_NAME != 'editAdmin'): ?>if(!isEmail($("input[name='email']").val())){
            popup.alert("账号邮件地址格式错误");
            return false;
        }
        if($.trim($("input[name='pwd']").val())==''){
            popup.alert("密码不能为空");
            return false;
        }<?php endif; ?>
            commonAjaxSubmit();
    });
</script>
</body>
</html>