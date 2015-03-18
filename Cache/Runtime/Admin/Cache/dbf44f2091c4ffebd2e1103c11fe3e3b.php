<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>节点管理-权限管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='权限管理 > 节点管理'; ?>
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
                        <div class="current">节点管理</div>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                                <td>序号</td>
                                <td>节点结构  <b title="单击分类隐藏/显示该分类下在子类">[i]</b></td>
                                <td>节点ID</td>
                                <td>名称</td>
                                <td>显示名</td>
                                <td>排序名称</td>
                                <td>类型</td>
                                <td>状态</td>
                                <td width="150">操作</td>
                            </tr>
                        </thead>
                        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr align="center" id="<?php echo ($vo["id"]); ?>" pid="<?php echo ($vo["pid"]); ?>">
                                <td><?php echo ($k); ?></td>
                                <td align="left" class="tree" style="cursor: pointer;"><?php echo ($vo["fullname"]); ?></td>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php echo ($vo["title"]); ?></td>
                                <td edit="0" fd="sort"><?php echo ($vo["sort"]); ?></td>
                                <td><?php echo ($vo["level"]); ?></td>
                                <td><?php echo ($vo["statusTxt"]); ?></td>
                                <td>[ <a href="javascript:void(0);" class="opStatus" val="<?php echo ($vo["status"]); ?>"><?php echo ($vo["chStatusTxt"]); ?></a> ] [ <a href="__URL__/editNode?id=<?php echo ($vo["id"]); ?>" class="edit">编辑</a> ]</td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
                //快捷启用禁用操作
                $(".opStatus").click(function(){
                    var obj=$(this);
                    var id=$(this).parents("tr").attr("id");
                    var status=$(this).attr("val");
                    $.getJSON("__URL__/opNodeStatus", { id:id, status:status }, function(json){
                        if(json.status==1){
                            popup.success(json.info);
                            $(obj).attr("val",json.data.status).html(status==1?"启用":"禁用").parents("td").prev().html(status==1?"禁用":"启用");
                        }else{
                            popup.alert(json.info);
                        }
                    });
                });

                //快捷改变操作排序dblclick
                $("tbody>tr>td[fd]").click(function(){
                    var inval = $(this).html();
                    var infd = $(this).attr("fd");
                    var inid =  $(this).parents("tr").attr("id");
                    if($(this).attr('edit')==0){
                        $(this).attr('edit','1').html("<input class='input' size='5' id='edit_"+infd+"_"+inid+"' value='"+inval+"' />").find("input").select();
                    }
                    $("#edit_"+infd+"_"+inid).focus().bind("blur",function(){
                        var editval = $(this).val();
                        $(this).parents("td").html(editval).attr('edit','0');
                        if(inval!=editval){
                            $.post("__URL__/opSort",{id:inid,fd:infd,sort:editval});
                        }
                    })
                });

                var chn=function(cid,op){
                    if(op=="show"){
                        $("tr[pid='"+cid+"']").each(function(){
                            $(this).removeAttr("status").show();
                            chn($(this).attr("id"),"show");
                        });
                    }else{
                        $("tr[pid='"+cid+"']").each(function(){
                            $(this).attr("status",1).hide();
                            chn($(this).attr("id"),"hide");
                        });
                    }
                }
                $(".tree").click(function(){
                    if($(this).attr("status")!=1){
                        chn($(this).parent().attr("id"),"hide");
                        $(this).attr("status",1);
                    }else{
                        chn($(this).parent().attr("id"),"show");
                        $(this).removeAttr("status");
                    }
                });
            });
        </script>
    </body>
</html>