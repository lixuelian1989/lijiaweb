<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberAction
 *
 * @author 李雪莲 <lixuelianlk@163.com>
 */
class MemberAction extends BaseAction {

    /**
     * 注册会员
     */
    public function register() {
        parent::_initialize();
        if (IS_POST) {
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $conf_pwd = $_POST['conf_pwd'];
            if (empty($username)) {
                $this->error("登录账户不能为空！");
                exit;
            }
            if (empty($pwd)) {
                $this->error("密码不能为空！");
                exit;
            }
            if (empty($conf_pwd)) {
                $this->error("确认密码不能为空！");
                exit;
            }
            if ($pwd != $conf_pwd) {
                $this->error("两次输入的密码不一致！");
                exit;
            }
            if (strlen($pwd) < 6 || strlen($pwd) > 20) {
                $this->error("密码只能是6到20位的字母或数字或特殊符号组成！");
                exit;
            }
            $mod = new MemberModel();
            $res = $mod->check_name($username);
            if ($res) {
                $this->error("账户已经存在！");
                exit;
            }
            $resault = $mod->register($username, $pwd);

            if ($resault) {
                $this->success("注册成功！", U("Member/index"));
            } else {
                $this->error("注册失败！");
            }


            exit;
        }
        $this->display();
    }

    /**
     * 会员中心
     */
    public function index() {
        $uid = session("uid");
        $username = session("username");
        if (empty($uid) || empty($username)) {
            $this->error("请登录！", U("Member/login"));
            exit;
        }
        $this->display();
    }

    /**
     * 退出
     */
    public function logout() {
        session("uid", "");
        session("username", "");
        $this->error("退出成功！", U("Member/login"));
    }

    /**
     * 登录
     */
    public function login() {
        if (IS_POST) {
            $username = trim($_POST['username']);
            $pwd = trim($_POST['pwd']);
            $pwd = encrypt($pwd);
            $M = new MemberModel();
            $res = $M->is_login($username, $pwd);
            if ($res['status']) {
                $this->success($res['msg'], U('Member/index'));
                exit;
            } else {
                $this->error($res['msg']);
                exit;
            }
        }


        $this->display();
    }

    /**
     * 忘记密码
     * 
     */
    public function find_pwd() {
        if (IS_POST) {
            $step = $_POST['step'];
            if ($step == 1) {
                $username = trim($_POST['username']);
                $M = new MemberModel();
                $re = $M->get_minfobyname($username);
                if ($re['status'] == 0) {
                    $this->error($re['msg']);
                } else {
                    $this->assign("yzfs", $re['msg']);
                    $this->assign("yzdata", $re['data']);
                    $this->assign("username", $username);
                    $this->assign("step", 2);

                    $this->display("find_pwd_2");
                }
            }
            if ($step == 2) {
                $yzm = trim($_POST['yzm']);
                $username = trim($_POST['username']);
                var_dump($username);
                if ($yzm == session("yanzheng")) {
                    $this->assign("step", 3);
                    $this->assign("username", $username);
                    $this->display("find_pwd_3");
                } else {
                    $this->error("请输入正确的验证码！", U("Member/find_pwd", array("step" => 1)));
                    exit;
                }
            }
            if ($step == 3) {
                $username = trim($_POST['username']);
                $pwd=trim($_POST['pwd']);
                $conf_pwd=trim($_POST['conf_pwd']);
                
                if($pwd!=$conf_pwd){
                    $this->error("两次输入的密码必须一致",U("Member/find_pwd", array("step" => 1)));
                    exit;
                }
                $pwd=  encrypt($pwd);
                $M = new MemberModel();
                $res=$M->where("username='".$username."'")->save(array("pwd"=>$pwd));
                if($res){
                    $this->display("find_pwd_4");
                }
            }
            exit;
        }        
        $step = $_GET['step'];
        if ($step == 1) {
            $this->assign("step", $step);
            $this->display("find_pwd_1");
        }
    }

    /**
     * 发送邮件
     */
    public function send_email() {
        #$ret=array("status"=>0,"msg"=>"发送邮件功能未开启");
        C('TOKEN_ON', false);
        $subject = "利嘉商圈-验证码";
        $yam = rand(1, 9);
        $yam.="" . rand(1, 9);
        $yam.="" . rand(1, 9);
        $yam.="" . rand(1, 9);
        $yam.="" . rand(1, 9);
        session("yanzheng", $yam);
        $return = send_mail($_POST['email'], "", $subject, "您的验证码是" . session("yanzheng"));
        if ($return)
            $ret = array("status" => 1, "msg" => "发送成功");
        else
            $ret = array("status" => 0, "msg" => "发送失败");

        echo json_encode($ret);
    }

    /**
     * 发送 手机验证码
     */
    public function send_phone() {
        $ret = array("status" => 0, "msg" => "发送手机验证码功能未开启");
        echo json_encode($ret);
    }

}
