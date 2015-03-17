<?php

class PublicAction extends Action {

    public $loginMarked;

    /**
      +----------------------------------------------------------
     * 初始化
      +----------------------------------------------------------
     */
    public function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
        $loginMarked = C("TOKEN");
        $this->loginMarked = md5($loginMarked['admin_marked']);
    }

    /**
      +----------------------------------------------------------
     * 验证token信息
      +----------------------------------------------------------
     */
    private function checkToken() {
        if (!M("Admin")->autoCheckToken($_POST)) {
            die(json_encode(array('status' => 0, 'info' => '令牌验证失败','url'=>__SELF__)));
        }
        unset($_POST[C("TOKEN_NAME")]);
    }

    public function index() {
        if (IS_POST) {
            //$this->checkToken();
            $returnLoginInfo = D("Public")->auth();
            //生成认证条件
            if ($returnLoginInfo['status'] == 1) {
                $map = array();
                // 支持使用绑定帐号登录
                $map['email'] = $this->_post('email');
                import('ORG.Util.RBAC');
                $authInfo = RBAC::authenticate($map);
                $_SESSION[C('USER_AUTH_KEY')] = $authInfo['aid'];
                $_SESSION['email'] = $authInfo['email'];
                if ($authInfo['email'] == C('ADMIN_AUTH_KEY')) {
                    $_SESSION[C('ADMIN_AUTH_KEY')] = true;
                }
                
                // 缓存访问权限
                RBAC::saveAccessList();
                $_SESSION['username']=$authInfo['username'];
                //记录管理员log
                $data=array("l_name"=>"管理员[".$authInfo['username']."]于[".date("Y-m-d H:i:s")."]登录了[28自习网]后台管理系统！",
                		"admin_id"=>$authInfo['aid'],
                		"admin_name"=>$authInfo['username'],
                		"l_cz"=>"登录",
                		"l_content"=>"管理员[".$authInfo['username']."]于[".date("Y-m-d H:i:s")."]登录了[28自习网]后台管理系统！",
                		"add_time"=>time()
                		);
                $al=D("AdminLog");
                $al->insert_one($data);
                
            }
            $returnLoginInfo['url']=__SELF__;
            echo json_encode($returnLoginInfo);
        } else {
            if (isset($_COOKIE[$this->loginMarked])) {
                $this->redirect("Index/index");
            }

            $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
            $this->assign("site", $systemConfig);
            $this->display("Common:login");
        }
    }

    public function loginOut() {
    	//记录管理员log
    	$data=array("l_name"=>"管理员[".$_SESSION['username']."]于[".date("Y-m-d H:i:s")."]退出了[28自习网]后台管理系统！",
    			"admin_id"=>$_SESSION[C('USER_AUTH_KEY')],
    			"admin_name"=>$_SESSION['username'],
    			"l_cz"=>"退出",
    			"l_content"=>"管理员[".$_SESSION['username']."]于[".date("Y-m-d H:i:s")."]退出了[28自习网]后台管理系统！",
    			"add_time"=>time()
    	);
    	$al=D("AdminLog");
    	$al->insert_one($data);
        setcookie("$this->loginMarked", NULL, -3600, "/");
        unset($_SESSION["$this->loginMarked"], $_COOKIE["$this->loginMarked"]);
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION['username']);
            unset($_SESSION);
            session_destroy();
        }
        $this->redirect("Index/index");
    }

    public function findPwd() {
        $M = M("Admin");
        if (IS_POST) {
            $this->checkToken();
            echo json_encode(D("Public")->findPwd());
        } else {
            setcookie("$this->loginMarked", NULL, -3600, "/");
            unset($_SESSION["$this->loginMarked"], $_COOKIE["$this->loginMarked"]);
            $cookie = $this->_get('code');
            $shell = substr($cookie, -32);
            $aid = (int) str_replace($shell, '', $cookie);
            $info = $M->where("`aid`='$aid'")->find();
            if ($info['status'] == 0) {
                $this->error("你的账号被禁用，有疑问联系管理员吧", __APP__);
            }
            if (md5($info['find_code']) == $shell) {
                $this->assign("info", $info);
                $_SESSION['aid'] = $aid;
                $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
                $this->assign("site", $systemConfig);
                $this->display("Common:findPwd");
            } else {
                $this->error("验证地址不存在或已失效", __APP__);
            }
        }
    }
    /**
     * 验证码
     */
    public function verify_code() {
        $w = isset($_GET['w']) ? (int) $_GET['w'] : 50;
        $h = isset($_GET['h']) ? (int) $_GET['h'] : 30;
        import("ORG.Util.Image");
        Image::buildImageVerify(4, 1, 'png', $w, $h);
    }
}