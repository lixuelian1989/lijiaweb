<?php
#define('THINK_PATH', './ThinkPHP/');
define('APP_NAME', 'Service');
define('APP_PATH', './Service/');
define('APP_DEBUG', TRUE);
define("WEB_ROOT", dirname(__FILE__) . "/");
define('SITE_URL', 'http://127.0.0.4/');
define('SYSTEM_URL', 'http://127.0.0.4/system.php/');
define('UPLOAD_PATH','./Uploads/scenic/');
/* define('SITE_PATH', getcwd());//网站当前路径
define("RUNTIME_PATH", SITE_PATH . "/Cache/Runtime/Home/");
//define("WEB_HTML_PATH", reset(explode("/", $_SERVER["DOCUMENT_ROOT"])) . "/Html/");
if (!file_exists(WEB_ROOT.'Common/systemConfig.php')) {
    header("Location: install/");
    exit;
} */
//require(THINK_PATH . "ThinkPHP.php");

require './Conist/ThinkPHP.php';
?>