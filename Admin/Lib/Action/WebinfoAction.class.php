<?php

// 本类设置项目一些常用信息
class WebinfoAction extends CommonAction {

    /**
      +----------------------------------------------------------
     * 配置网站信息
      +----------------------------------------------------------
     */
    public function index() {
        $this->checkSystemConfig();
    }

    /**
      +----------------------------------------------------------
     * 配置网站邮箱信息
      +----------------------------------------------------------
     */
    public function setEmailConfig() {
        $this->checkSystemConfig("SYSTEM_EMAIL");
    }

    /**
      +----------------------------------------------------------
     * 配置网站信息
      +----------------------------------------------------------
     */
    public function setSafeConfig() {
        $this->checkSystemConfig("TOKEN");
    }

    /**
     * 配置微信
     */
    public function setWeixin(){
        $this->checkSystemConfig("WEIXIN");
    }
    /**
     * 配置显示设置
     */
    public function setListNum(){
        $this->checkSystemConfig("LISTNUM");
    }
    /**
     * 配置短信设置
     */
    public function setDuanXin(){
        $this->checkSystemConfig("DUANXIN");
    }
     /**
     * 配置视频设置
     */
    public function setShiPin(){
        $this->checkSystemConfig("SHIPIN");
    }
    
    public function gethtaccess(){
        $root=__ROOT__;
		if(!$root){$root='/';}
       $str=<<<str
##将下面代码保存为.htaccess文件放到网站根目录
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteBase $root
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>'
str;
echo  $str;
    }

    /**
      +----------------------------------------------------------
     * 网站配置信息保存操作等
      +----------------------------------------------------------
     */
    private function checkSystemConfig($obj = "SITE_INFO") {
        if (IS_POST) {
            $this->checkToken();
            $config = WEB_ROOT . "Common/systemConfig.php";
            $config = file_exists($config) ? include "$config" : array();
            $config = is_array($config) ? $config : array();
            $config = array_merge($config, array("$obj" => $_POST));
            $str = $obj == "SITE_INFO" ? "网站配置信息" : $obj == "SYSTEM_EMAIL" ? "系统配置" : "安全设置";
            if (F("systemConfig", $config, WEB_ROOT . "Common/")) {
                delDirAndFile(WEB_CACHE_PATH . "Runtime/Admin/~runtime.php");
                if ($obj == "TOKEN") {
                    unset($_SESSION, $_COOKIE);
                    echo json_encode(array('status' => 1, 'info' => $str . '已更新，你需要重新登录', 'url' => __APP__ . '?' . time()));
                } else {
                    echo json_encode(array('status' => 1, 'info' => $str . '已更新','url'=>__SELF__));
                }
            } else {
                echo json_encode(array('status' => 0, 'info' => $str . '失败，请检查', 'url' => __ACTION__));
            }
        } else {
            $this->display();
        }
    }
    /**
      +----------------------------------------------------------
     * 测试邮件账号是否配置正确
      +----------------------------------------------------------
     */
    public function testEmailConfig() {
        C('TOKEN_ON', false);
        $return = send_mail($_POST['test_email'], "", "测试配置是否正确", "这是一封测试邮件，如果收到了说明配置没有问题", "", $_POST);
        if ($return == 1) {
            echo json_encode(array('status' => 1, 'info' => "测试邮件已经发往你的邮箱" . $_POST['test_email'] . "中，请注意查收"));
        } else {
            echo json_encode(array('status' => 0, 'info' => "$return"));
        }
    }

}

?>