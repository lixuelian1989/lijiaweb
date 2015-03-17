<?php

class UserAction extends BaseAction {

    public $loginMarked;
    public $webtitle;

    public function __construct() {
        parent::__construct();
    }

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
        $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
        $this->assign("site", $systemConfig);
    }

    /*
     * 用户登录
     */

    public function index() {
        if (isset($_SESSION['user_info'])) {
            $this->redirect("center");
        }
        if (IS_POST) {
            #var_dump($_POST);exit;
            $returnLoginInfo = $this->auth();
//            $this->show_message_page($returnLoginInfo);
            # echo json_encode($returnLoginInfo);
            if ($returnLoginInfo['status'] == 1) {
                // 正常登录成功
                $this->success($returnLoginInfo['info'], $returnLoginInfo['url']);
            } else {
                $this->error($returnLoginInfo['info']);
            }

            exit;
        } else {
            $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
            $this->assign("site", $systemConfig);
            if (isset($_COOKIE['pwd']) && $_COOKIE['pwd'] !== '') {
                $pwd = $this->authcode($_COOKIE['pwd'], 'DECODE');
                $this->assign("pwd", $pwd);
            }
            $this->webtitle = '登录';
            $this->assign("webtitle", $this->webtitle);
            $this->display("User:login");
        }
    }

    /**
     * 用户注册协议
     */
    public function xieyi() {
        $m_page = M('page');
        $map['lang'] = $map2['lang'] = LANG_SET;
        $map['unique_id'] = "xieyi";
        $map['display'] = 1;

        $info = $m_page->where($map)->find();
        $this->assign("info", $info);

        $this->assign("webtitle", "用户注册协议-" . L('T_Center'));
        $this->display("User:xieyi");
    }

    /*
     * 用户注册
     */

    public function regist() {
        //加密解密
        //print_r($this->authcode("1",'encode')); 加密
        //print_r($this->authcode('9baf4By7+ztiEWo7cn4k++C9zfNWv2QQOYUjPoLV','DECODE')); 解密
        //判断是否登录
        if (isset($_SESSION['user_info'])) {
            $this->redirect("User/index");
        }
        if (IS_POST) {

            $m_member = M('Member');
            $data = $_POST['info'];
            $id = $this->_post('id');


            if ($data['phone'] == '') {
                $message = array("status" => 0, "info" => "手机号码不能为空");
                $this->show_message_page($message);
                exit;
            } else {

                $sm = array('phone' => $data['phone']);
                if ($m_member->where($sm)->count() > 0) {
                    $message = array("status" => 0, "info" => "手机号码已经在数据库中存在！");
                    $this->show_message_page($message);
                    exit;
                }
            }

            if ($data['nickname'] == '') {
                $message = array("status" => 0, "info" => "用户名不能为空！");
                $this->show_message_page($message);
                exit;
            } else {
                //检查是否注册过
                $sm = array('nickname' => $data['nickname']);
                if ($m_member->where($sm)->count() > 0) {
                    $message = array("status" => 0, "info" => "用户名已存在！");
                    $this->show_message_page($message);
                    exit;
                }
            }

            if ($data['upwd'] == '') {
                $message = array("status" => 0, "info" => "密码不能为空！");
                $this->show_message_page($message);
                exit;
            } else {
                $data['upwd'] = $data['upwdconf'];
                $data['pwd'] = md5($data['upwd']);
            }

            $data['addtime'] = time();
            $data['reg_date'] = time();
            $data['reg_ip'] = $_SERVER['REMOTE_ADDR'];
            $yzm = $_POST['yzm'];
            if ($_SESSION['yzm'] != $yzm) {
                $message = array("status" => 0, "info" => "验证码输入错误！");
                $this->show_message_page($message);
                exit;
            }

            $result = $m_member->add($data);
            if ($result) {
                //得到刚插入的id
                $new_id = $m_member->getLastInsID();
                $datas['uid'] = $new_id;
                $info = $m_member->where($datas)->find();
                $_SESSION['user_info'] = $info;
                unset($_SESSION['yzm']);
                $message = array("status" => 1, "info" => '用户注册成功!', 'url' => U('User/index'));
                $this->show_message_page($message);
                exit;
            } else {
                //echo $ZSD->getLastSql();
                $message = array("status" => 0, "info" => "用户注册失败!");
                $this->show_message_page($message);
                exit;
            }
        } else {

            $this->assign("webtitle", L('T_Register'));

            $this->display("User:add");
        }
    }

    /**
     * 会员中心
     */
    public function center() {
        $user_info = $_SESSION['user_info'];

        $this->get_menu($user_info['mtype']);

        $this->assign("webtitle", L('T_Center'));

        $this->display();
    }

    /**
     * 退出
     * @param type $message
     */
    public function logout() {
        unset($_SESSION['user_info']);
        $this->redirect('index');
    }

    /**
     * 修改密码
     */
    public function update_pwd() {
        $webtitle = "修改密码";
        $this->assign("webtitle", $webtitle);
        $uid = $_SESSION['user_info']['uid'];
        if ($uid == '') {
            $this->error("操作失败【请登录】", 'index');
            exit;
        }
        if ($_POST) {
            $oldpwd = trim($_POST['oldpwd']);
            $newpwd = trim($_POST['newpwd']);
            $confpwd = trim($_POST['confpwd']);
            if (empty($oldpwd)) {
                $this->error("操作失败【原来的密码不能为空】");
                exit;
            }
            if (empty($newpwd)) {
                $this->error("操作失败【新的密码不能为空】");
                exit;
            }
            if (empty($confpwd)) {
                $this->error("操作失败【确认密码不能为空】");
                exit;
            }
            if ($newpwd != $confpwd) {
                $this->error("操作失败【两次输入的密码不能为空】");
                exit;
            }
            //检查输入的密码 是否正确
            $mMod = D("Member");
            $cou = $mMod->check_pwd($uid, $oldpwd);
            if ($cou == 0) {
                $this->error("操作失败【原来的密码输入错误】");
                exit;
            }
            //修改密码
            $res = $mMod->where(array('uid' => $uid))->save(array('pwd' => md5($newpwd)));
            if ($res) {
                unset($_SESSION['user_info']);
                $this->success("操作成功！", 'index');
            } else {
                $this->error("操作失败【请联系管理员】");
            }
        }


        $this->display();
    }

    /**
     * 设置个人信息
     */
    public function set_userinfo() {
        if (!isset($_SESSION['user_info']))
            $this->redirect('index');

        $this->assign('webtitle', L("T_Center") . "-" . L("T_Set_userinfo"));
        $user_info = $_SESSION['user_info'];
        $this->get_menu($user_info['mtype']);
        //生日
        $birthday = require_once './Home/conf/config_birthday.php';
        $this->assign('birthday', $birthday);

        $mod = M("Member");
        $user_info = $mod->where(array('uid' => $_SESSION['user_info']['uid']))->find();

        if (!empty($user_info['birthday'])) {
            $bir_arr = explode('-', $user_info['birthday']);
            $birthday_y = $bir_arr[0];
            $birthday_m = $bir_arr[1];
            $birthday_d = $bir_arr[2];
            $this->assign('birthday_y', $birthday_y);
            $this->assign('birthday_m', $birthday_m);
            $this->assign('birthday_d', $birthday_d);
        }
        $user_info['avatar'] = empty($user_info['avatar']) ? "/Home/Tpl/default/Public/images/dlt_07.jpg" : "/Uploads/avatar/" . $user_info['avatar'];
        $this->assign('user_info', $user_info);

        if (IS_POST) {
            $info = $_POST['info'];
            $uid = $_SESSION['user_info']['uid'];

            $info['birthday'] = $_POST['byear'] . "-" . $_POST['bmonth'] . "-" . $_POST['bday'];

            $res = $mod->where(array('uid' => $uid))->save($info);

            if ($res) {
                $this->success("操作成功!");
                exit;
            } else {
                $this->error("操作失败!");
                exit;
            }
        }
        $this->display();
    }

    /**
     * 个人信息
     */
    public function myinfo() {
        if (!isset($_SESSION['user_info']))
            $this->redirect('index');

        $this->assign('webtitle', L("T_Center") . "-" . L("T_Myinfo"));
        $user_info = $_SESSION['user_info'];
        $this->get_menu($user_info['mtype']);

        $uid = $_SESSION['user_info']['uid'];
        $mod = M("Member");
        $user_info = $mod->where(array('uid' => $uid))->find();

        $this->assign('user_info', $user_info);
        $this->display();
    }

    /**
     * 更改头像
     */
    public function update_avatar() {
        if ($_FILES['avatar_img']['name'] != '') {
            $info = $this->upload();

            if ($info[0]['savename'] != '') {
                $model = M("Member");
                $uid = $_SESSION['user_info']['uid'];
                $url = $info[0]['savename'];
                $res = $model->where(array('uid' => $uid))->save(array('avatar' => $url));
                if ($res) {
                    $this->success("操作成功!");
                } else {
                    $this->error("操作失败!");
                }
            }
        } else {
            $this->error("请选择图片!");
        }
    }

    /**
     * 拍卖管理
     */
    public function paimai() {
        $this->get_pre_paimai();
        $this->assign("dqaction", "paimai");
        $this->display();
    }

    /**
     * 流拍
     */
    public function out_paimai() {
        $this->get_pre_paimai();
        $this->assign("dqaction", "out_paimai");
        $this->display();
    }

    /**
     * 未拍卖
     */
    public function no_paimai() {
        $this->get_pre_paimai();
        $this->assign("dqaction", "no_paimai");
        $this->display();
    }

    /**
     * 新增拍卖
     */
    public function add_paimai() {
        $this->get_pre_paimai();
        $this->assign("dqaction", "add_paimai");
        $this->display();
    }

    /**
     * 导入车辆 第一步
     */
    public function import_car() {
        $this->get_pre_paimai();
        $this->get_cardiqu(); //获取地区
        if (IS_POST) {
            $carMod = D("CarView");
            $map = array();
            $map["status"] = 0;
            $__Filter['vin_number']=  trim($_POST['vin_number']);
            $__Filter['chepai_diqu']=  trim($_POST['chepai_diqu']);
            $__Filter['chepai_num']=  trim($_POST['chepai_num']);
            if(!empty($__Filter['vin_number']))
                $map['vin_number']=$__Filter['vin_number'];
            
            if(!empty($__Filter['chepai_diqu']))
                $map['chepai_diqu']=$__Filter['chepai_diqu'];
            
            if(!empty($__Filter['chepai_num']))
                $map['chepai_num']=$__Filter['chepai_num'];
            
            import("ORG.Util.Page"); //载入分页类
            $count = $carMod->where($map)->count();
            $page = new Page($count, 10);
            $showPage = $page->show();
            $this->assign("page", $showPage);

            $list = $carMod->where($map)->order("addtime desc")->limit($page->firstRow . "," . $page->listRows)->select();
            
            foreach ($list as $k => $v) {
                $list[$k]['img_thumb_url'] = empty($v['img_thumb_url']) ? __ROOT__ . "/Home/Tpl/default/Public/images/zc_img27.jpg" : $v['img_thumb_url'];
                $list[$k]['adddate'] = date("Y.m.d", $v['addtime']);
            }

            $this->assign('list', $list);
            $this->assign("searchinfo",$__Filter);
        }
        $this->display();
    }
    
    /**
     * 导入车辆 第二步骤
     */
    public function import_car_2(){
        $this->get_pre_paimai();
        $id=$_GET['id'];
        if(empty($id)){
            $this->error("请选择要导入的车辆！");
           exit; 
        }
        $cMod=D("CarView");
        $map=array();
        $map['id']=$id;
        $info=$cMod->where($map)->find();
        $this->assign('info',$info);
        $this->get_cardiqu();
        $this->get_sheng();
        $this->display();
    }
    
    
    //----------------------内部使用方法
    private function get_pre_paimai() {
        $user_info = $_SESSION['user_info'];
        if (!isset($user_info))
            $this->redirect('index');
        $this->assign('webtitle', L("T_Center") . "-" . L("T_Paimai"));
        $utype = $user_info['utype'];
        $this->get_menu($utype);
    }

    /**
     * ajax 获取 日期
     */
    public function ajax_getday() {
        $birthday = require_once './Home/conf/config_birthday.php';
        #var_dump($birthday);
        $month = $_POST['month'];
        $year = $_POST['year'];
        if ($year % 4 == 0) {
            echo json_encode(array('days' => $birthday['bday_29']));
        } else {
            echo json_encode(array('days' => $birthday['bday_28']));
        }
    }

    /**
     * 
     * 显示提示页面
     * @param type $message
     */
    public function show_message_page($message) {
        $this->assign("message", $message);
        $this->assign("webtitle", L('T_Message'));
        $this->display("add_success");
    }

    /*
     * 注册邮件激活
     */

    public function regist_active() {

        $M = M("User");
        //查询邮件是否被激活


        $result = $this->url_jiexi($this->_param());
        $mid = $result['mid'];
        $time = $result['time'];
        // print_r($result);
        $info = $M->where("`id`='$mid'")->find();
        //判断链接是否过期
        if (($time + 3600 * 24 > time()) && $info) {
            if ($info['status'] == 1) {
                $tishi = '恭喜您，您的邮件已经激活成功，返回<a href="' . U('User/index') . '">&nbsp; &nbsp;首页 &nbsp; &nbsp;</a>';
                $message = array("status" => 1, "info" => $tishi);


                $this->show_message_page($message);
            } else {
                $data['id'] = $mid;
                $data['is_yz'] = 1;
                if ($M->save($data)) {
                    //跳转激活成功提示页面
                    $tishi = '恭喜您，注册激活成功，请返回<a href="' . U('User/index') . '">&nbsp; &nbsp;首页 &nbsp; &nbsp;</a>';
                    $message = array("status" => 1, "info" => $tishi);

                    $this->show_message_page($message);
                } else {
                    //跳转激活失败提示页面
                    $tishi = '很遗憾，注册激活失败，请重新<a href="' . U('User/index') . '">&nbsp; &nbsp;激活&nbsp; &nbsp;</a>';
                    $message = array("status" => 0, "info" => $tishi);

                    $this->show_message_page($message);
                }
            }
        } else {
            $tishi = "验证地址不存在或已失效";

            $message = array("status" => 0, "info" => $tishi);

            $this->show_message_page($message);
        }
    }

    /*
     * 登录验证
     * * */

    public function auth($datas) {
        $datas = $_POST;
        $M = D("Member");
        $map = array();
        $map['nickname'] = $datas['uname'];
        $map['phone'] = $datas['uname'];
        $map['_logic'] = "OR";

        if ($M->where($map)->count() >= 1) {
            $info = $M->where($map)->find();

            if ($info['pwd'] == md5($datas['upwd'])) {

                $_SESSION['user_info'] = $info;

                if ($_POST['rember'] == 1) {
                    $remeberinfo = json_encode(array("uname" => $datas['uname'], "upwd" => $datas['upwd']));
                    //$remeberinfo=$datas['uname'];
                    $rembertime = 60 * 60 * 24;
                    cookie('rember', $remeberinfo, $rembertime);
                }

                //修改 会员登录时间 登录iP
                $M->update_logininfo($info['uid']);
                return array('status' => 1, 'info' => "登录成功", 'url' => U("User/center"));
            } else {
                return array('status' => 0, 'info' => "密码输入错误");
            }
        } else {
            return array('status' => 0, 'info' => "手机号码或者用户名输入错误");
        }
    }

    /*
     * 找回密码 -》填写账户名
     */

    public function findPwd_account() {
        if (IS_POST) {
            //验证是否存在
            $datas = $_POST;
            if ($_SESSION['verify'] != md5($_POST['verify_code'])) {
                die(json_encode(array('status' => 0, 'info' => "验证码错误啦，再输入吧")));
            }

            $M = M("Member");
            if ($M->where("`email`='" . $datas['email'] . "' or `phone`='" . $datas['email'] . "' or `name`='" . $datas['email'] . "'")->count() >= 1) {

                $info = $M->where("`email`='" . $datas["email"] . "' or `phone`='" . $datas['email'] . "' or `name`='" . $datas['email'] . "'")->find();

                echo json_encode(array('status' => 1, 'info' => '请选择下一步操作', 'url' => U('User/findPwd_check', array('mid', $info['mid']))));
            } else {
                echo json_encode(array('status' => 0, 'info' => "不存在用户名/邮箱/手机号码为：" . $datas["email"] . '的账号！'));
                exit;
            }
        } else {
            $this->assign("webtitle", "找回密码");
            $this->display("User:findPwd_account");
        }
    }

    /* 找回密码 -》验证身份
     */

    public function findPwd_check() {
        $mid = $_GET['1'];
        if (!$mid) {
            $this->redirect('user/findPwd_account');
        }
        if (IS_POST) {
            $datas = $_POST;
            //print_r($datas);
            if ($datas['type'] == 'email') { //email
                //发送验证邮件
                $mid = $datas['mid'];
                $info = D("User")->sel_user_one(array('mid' => $mid));
                $code = urlencode($this->authcode($info['name'] . '__' . $info['mid'] . '__' . time(), 'encode'));
                $url = str_replace(C("webPath"), "", C("WEB_ROOT")) . U("User/findPwd", array("code" => $code));
                $body = "请在浏览器上打开地址：<a href='$url'>$url</a> 进行密码重置操作,此链接的有效期为 1小时";

                //var_dump($info['email']);

                $to = $info['email'];

                $ss = send_mail($to, "", "找回密码", $body);
                if ($ss) {
                    echo json_encode(array('status' => 1, 'info' => '验证邮件已发送，请您登录邮箱完成验证 ' . $info['email'] . ' '));
                    exit;
                } else {
                    echo json_encode(array('status' => 0, 'info' => '请选择下一步操作'));
                    exit;
                }
            } else { // mobile
            }
        } else {
            $info = D("User")->sel_user_one(array('mid' => $mid));
            if ($info) {
                $this->assign($info);
                $this->assign("webtitle", "找回密码");
                $this->display("User:findPwd_check");
            } else {
                $this->assign("webtitle", "找回密码");
                $this->redirect('user/findPwd_account');
            }
        }
    }

    /* 找回密码 -》填写新密码
     */

    public function findPwd() {
        $M = M("Member");
        $result = $this->url_jiexi($this->_param());
        $mid = $result['mid'];
        $time = $result['time'];

        if (IS_POST) {
            echo json_encode(D("User")->findPwd());
        } else {
            $info = $M->where("`mid`='$mid'")->find();
            //判断时间是否过期
            if (($time + 3600 * 24 > time()) && $info) {
                $this->assign("info", $info);
                $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
                $this->assign("site", $systemConfig);
                $this->display("User:findPwd");
            } else {
                $this->error("验证地址不存在或已失效", __APP__);
            }
        }
    }

    /*
     * 找回密码提示页面
     * */

    public function findPwd_success() {
        //print_r('成功找回密码');
        $tishi = '成功找回密码';
        $this->assign("webtitle", "提示页面");
        $this->assign("tishi", $tishi);
        $this->display("User:success");
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

    /**
     * 获取验证码 手机
     */
    public function ajax_getyzm() {
        $sum = rand(100000, 999999);
        $_SESSION['yzm'] = $sum;

        echo json_encode($sum);
    }

    /**
     * 获取用户菜单
     */
    public function get_menu($utype) {
        if ($utype == 1) {
            //买家
            $menu = require_once './Home/conf/config_user.php';
        } else {
            //卖家
            $menu = require_once './Home/conf/config_mai_user.php';
        }
        $this->assign("menu", $menu);
    }

    /**
     * 获取 汽车
     */
    public function get_cardiqu() {
        $diqu = require_once './Home/conf/config_cardiqu.php';
        $carinfo = require_once './Home/conf/config_carinfo.php';
       
        $this->assign('carinfo',$carinfo);
        $this->assign("diqu", $diqu);
    }
    /**
     * 获取 省 市 区
     */
    public function get_sheng(){
        $model=M("sheng");
        $shenglist=$model->where($map)->select();
        
        $this->assign("shenglist",$shenglist);
    }

    /**
     * 上传图片
     */
    public function upload($path = './Uploads/avatar/') {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 1024 * 1024 * 2; // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->savePath = $path; // 设置附件上传目录
        $upload->saveRule = uniqid();
        if (!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
            exit;
        } else {// 上传成功 获取上传文件信息
            return $info = $upload->getUploadFileInfo();
        }
    }

}
