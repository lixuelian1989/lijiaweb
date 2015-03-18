<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>权限分配-权限管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
        <?php $addCss=""; $addJs=""; $currentNav ='权限管理 > 权限分配'; ?>
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
                        <div class="current">权限分配</div>
                    </div>
                    <p>你正在为用户组：<b><?php echo ($info["name"]); ?></b> 分配权限 。项目和版块有全选和取消全选功能</p>
                    <form>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                            <?php if(is_array($nodeList)): $i = 0; $__LIST__ = $nodeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level1): $mod = ($i % 2 );++$i;?><tr>
                                    <td style="font-size: 14px;"><label><input name="data[]" level="1" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>" value="<?php echo ($level1["id"]); ?>:1:0"/> <b>[项目]</b> <?php echo ($level1["title"]); ?></label></td>
                                </tr>
                                <?php if(is_array($level1['data'])): $i = 0; $__LIST__ = $level1['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level2): $mod = ($i % 2 );++$i;?><tr>
                                        <td style="padding-left: 30px; font-size: 14px;"><label><input name="data[]" level="2" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>_<?php echo ($level2["id"]); ?>" value="<?php echo ($level2["id"]); ?>:2:<?php echo ($level2["pid"]); ?>"/> <b>[模块]</b> <?php echo ($level2["title"]); ?></label></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 50px;">
                                            <?php if(is_array($level2['data'])): $i = 0; $__LIST__ = $level2['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level3): $mod = ($i % 2 );++$i;?><label><input name="data[]" level="3" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>_<?php echo ($level2["id"]); ?>_<?php echo ($level3["id"]); ?>" value="<?php echo ($level3["id"]); ?>:3:<?php echo ($level3["pid"]); ?>"/> <?php echo ($level3["title"]); ?></label> &nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                        </table>
                        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
                        <button class="btn reset">重置</button>
                        <button class="btn empty">清空</button>
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
            //初始化数据
            function setAccess(){
                //清空所有已选中的
                $("input[type='checkbox']").prop("checked",false);
                //数据格式：
                //节点ID：node_id；1，项目；2，模块；3，操作
                //节点级别：level；
                //父级节点ID：pid
                var access=$.parseJSON('<?php echo ($info["access"]); ?>');
                var access_length=access.length;
                if(access_length>0){
                    for(var i=0;i<access_length;i++){
                        $("input[type='checkbox'][value='"+access[i]['val']+"']").prop("checked","checked");
                    }
                }
            }
            $(function(){
                //执行初始化数据操作
                setAccess();
                //为项目时候全选本项目所有操作
                $("input[level='1']").click(function(){
                    var obj=$(this).attr("obj")+"_";
                    $("input[obj^='"+obj+"']").prop("checked",$(this).prop("checked"));
                });
                //为模块时候全选本模块所有操作
                $("input[level='2']").click(function(){
                    var obj=$(this).attr("obj")+"_";
                    $("input[obj^='"+obj+"']").prop("checked",$(this).prop("checked"));
                    //分隔obj为数组
                    var tem=obj.split("_");
                    //将当前模块父级选中
                    if($(this).prop('checked')){
                        $("input[obj='node_"+tem[1]+"']").prop("checked","checked");
                    }
                });
                //为操作时只要有勾选就选中所属模块和所属项目
                $("input[level='3']").click(function(){
                    var tem=$(this).attr("obj").split("_");
                    if($(this).prop('checked')){
                        //所属项目
                        $("input[obj='node_"+tem[1]+"']").prop("checked","checked");
                        //所属模块
                        $("input[obj='node_"+tem[1]+"_"+tem[2]+"']").prop("checked","checked");
                    }
                });
                //重置初始状态，勾选错误时恢复
                $(".reset").click(function(){
                    setAccess();
                });
                //清空当前已经选中的
                $(".empty").click(function(){
                    $("input[type='checkbox']").prop("checked",false);
                });
                $(".submit").click(function(){
                    commonAjaxSubmit();
                });
            });
        </script>
    </body>
</html>