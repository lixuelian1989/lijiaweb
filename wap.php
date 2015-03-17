<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-10
 * Time: 上午9:23
 */
ob_start();
ini_set('date.timezone', 'Asia/Shanghai');
define('THINK_PATH', './Conist/');
define('APP_NAME', 'Wap');
define('APP_PATH', './Wap/');
define('APP_DEBUG', TRUE);
define('SITE_PATH', getcwd());//网站当前路径
define("RUNTIME_PATH", SITE_PATH . "/Cache/Runtime/Wap/");
define("WEB_ROOT", dirname(__FILE__) . "/");
//define("WEB_HTML_PATH", reset(explode("/", $_SERVER["DOCUMENT_ROOT"])) . "/Html/");
if (!file_exists(WEB_ROOT.'Common/systemConfig.php')) {
    exit;
}
require(THINK_PATH . "ThinkPHP.php");