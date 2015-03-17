<?php
$config_arr1 = include_once WEB_ROOT . 'Common/config.php';
$config_arr2 = array(
    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        =>'zh-cn,zh-en', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l',// 默认语言切换变量
    'TAGLIB_LOAD' => true,//加载标签库打开
    'APP_AUTOLOAD_PATH' => '@.TagLib',//标签库的文件名
    'TAGLIB_BUILD_IN' => 'Cx,Weblock',//标签库类名

    //'URL_HTML_SUFFIX'       =>$config_arr1['TOKEN']['URL_HTML_SUFFIX'],  // URL伪静态后缀设置
    'TMPL_DETECT_THEME'     => true,       // 自动侦测模板主题
    'DEFAULT_THEME'          =>'default',
    'LAYOUT_ON'              =>true,
    //'URL_MODEL' => $config_arr1['TOKEN']['false_static'],// URL伪静态设置/开启，关闭

);
return array_merge($config_arr1, $config_arr2);
?>