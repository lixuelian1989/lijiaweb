<?php
class MemberModel extends Model  {
    /**
     * 检查密码输入是否正确
     * @param type $uid 用户编号
     * @param type $newpwd 新密码
     */
    function check_pwd($uid,$newpwd){
        $cou=$this->where(array('uid'=>$uid,'pwd'=>md5($newpwd)))->count();
        return $cou;
    }
    /**
     * 修改密码
     */
    function update_logininfo($uid){
        $data=array(
            "login_ip"=>$_SERVER['REMOTEADDR'],
            "login_time"=>  time()
        );
        $this->where(array('uid'=>$uid))->save($data);
    }
    /**
     * 检查用户名输入的是否正确
     */
    public function check_name($name){
        $map=array("username"=>$name);
        $res=$this->where($map)->count();
        if($res)
            return TRUE;
        else
            return FALSE;
    }
    /**
     * 注册
     */
    public function register($username,$pwd){
        $pwd=encrypt($pwd);
        $data=array(
            "username"=>$username,
            "pwd"=>$pwd,
            "reg_time"=>  time(),
            "reg_ip"=>$_SERVER[REMOTE_ADDR],
            "utype"=>1
        );
        $res=$this->add($data);
        
        $id=  $this->getLastInsID();
        if($res){
            session("uid",$id);
            session("username",$username);
            return true;
        }else{
            return false;
        }
    }
    /**
     * 登录
     */
    public function is_login($username,$pwd){
       
        $map="username='".$username."' or email='".$username."' or phone='".$username."'";
        $res=M("Member")->where($map)->field("uid,pwd,username")->find();
       # echo $this->getLastSql();
        #var_dump($res);exit;
        if($res){
            if($res['pwd']==$pwd){
                session("uid",$res['uid']);
                session("username",$res['username']);
                
                $return=array("status"=>1,"msg"=>"登录成功！");
            }else{
                $return=array("status"=>0,"msg"=>"密码输入错误！");
            }
        }else{
            $return=array("status"=>0,"msg"=>"用户名输入错误！");
        }
        return $return;
    }
    /**
     * 找回密码 根据用户名或者邮箱或者手机号 获取用户的邮箱或者手机号
     * 
     */
    public function get_minfobyname($username){
        $map="username='".$username."' or email='".$username."' or phone='".$username."'";
        $res=M("Member")->where($map)->field("uid,username,email,phone")->find();
        if($res['email']==""&&$res['phone']==""){
            $return=array("status"=>0,"msg"=>"邮箱和手机号没有绑定故不能找回密码");
        }elseif($res['email']!=""&&$res['phone']==""){
            $data=array("email"=>$res['email'],"phone"=>$res['phone']);
            $return=array("status"=>1,"msg"=>array("1"=>"邮箱验证"),"data"=>$data);
        }
        elseif($res['email']==""&&$res['phone']!=""){
            $data=array("email"=>$res['email'],"phone"=>$res['phone']);
            $return=array("status"=>2,"msg"=>array("2"=>"手机验证"),"data"=>$data);
        }
        else{
            $data=array("email"=>$res['email'],"phone"=>$res['phone']);
            $return=array("status"=>3,"msg"=>array("1"=>"邮箱验证","2"=>"手机验证"),"data"=>$data);
        }
        return $return;
    }
}
?>