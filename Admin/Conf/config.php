<?php

$config_arr1 = include_once WEB_ROOT . 'Common/config.php';
$DB_PREFIX = $config_arr1['DB_PREFIX'];
$config_arr2 = array(
    'admin_big_menu' => array(
        'Index' => '首页',
		'News'=>'新闻管理',
		'Member'=>"会员管理",
        'Siteinfo'=>'网站功能',
        'Webinfo'=>'系统设置',
        'SysData' => '数据管理',
        'Access' => '权限管理',
	'Zhaopin'=>"招聘信息管理",	
    ),
    'admin_sub_menu' => array(
        'Common' => array(
            'Index/myInfo' => '修改密码',
            'Index/cache' => '缓存清理',
            'News/add' => '新闻发布'
        ),
        'Webinfo' => array(
            'index' => '站点配置',
            'setEmailConfig' => '邮箱配置',
            'setSafeConfig' => '安全配置',
            //'setWeixin'=>'微信配置',
            'setListNum'=>'显示设置',
            'setDuanXin'=>'短信设置',
            'setShiPin' =>'视频设置',
        ),
        'Member' => array(
            'index' => '注册用户列表',
        ),
 		'News'=>array(
        	'index'=>"新闻列表",
        	'add'=>"发布新闻",
        'category'=>'文章分类',
        ),
        'Siteinfo'=>array(
            'index'=>'导航菜单',
            'adindex'=>'轮播管理',
            'page'=>'单页管理',
            'tag_index'=>'标签管理',
            'create_tag'=>'模版标签',
            'file_index'=>'文件管理',
            'link_index'=>'友情链接',
            'message'=>'留言信息',
        	'adminlog_index'=>'管理员log记录'
        ),
        'SysData' => array(
            'index' => '数据库备份',
            'restore' => '数据库导入',
            'zipList' => '数据库压缩包',
            'repair' => '数据库优化修复'
        ),
        'Access' => array(
            'index' => '后台用户',
            'nodeList' => '节点管理',
            'roleList' => '角色管理',
            'addAdmin' => '添加管理员',
            'addNode' => '添加节点',
            'addRole' => '添加角色',
        ),
        "Zhaopin"=>array(
            "index"=>"招聘信息列表",
            "add"=>"发布招聘信息",
        ),
        "Laws"=>array(
        	'index'=>'法规管理',
        	'lawstype'=>'法规类型',
        	"lawscountry"=>'法规颁布国家',
        	"lawsmodule"=>"车型管理"
        )
    ),
    /*
     * 以下是RBAC认证配置信息
     */
    'USER_AUTH_ON' => true,
    'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
//    'ADMIN_AUTH_KEY' => '281978297@qq.com',
    'USER_AUTH_MODEL' => 'Admin', // 默认验证数据表模型
    'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式encrypt
    'USER_AUTH_GATEWAY' => '/system.php/Public/index', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块
    'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
    'NOT_AUTH_ACTION' => '', // 默认无需认证操作
    'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
    'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
    'GUEST_AUTH_ID' => 0, // 游客的用户ID
    'RBAC_ROLE_TABLE' => $DB_PREFIX . 'role',
    'RBAC_USER_TABLE' => $DB_PREFIX . 'role_user',
    'RBAC_ACCESS_TABLE' => $DB_PREFIX . 'access',
    'RBAC_NODE_TABLE' => $DB_PREFIX . 'node',

    /*
     * 系统备份数据库时每个sql分卷大小，单位字节
     */
    'sqlFileSize' => 5242880, //该值不可太大，否则会导致内存溢出备份、恢复失败，合理大小在512K~10M间，建议5M一卷
        //10M=1024*1024*10=10485760
        //5M=5*1024*1024=5242880
    'QRCODE'=>false, //后台二维码地址
);
return array_merge($config_arr1, $config_arr2);
?>