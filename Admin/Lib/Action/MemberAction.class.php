<?php

class MemberAction extends CommonAction {

    public function index() {

        $M = M("Member");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $list=$M->order('uid desc')->limit("$page->firstRow, $page->listRows")->select();
        $this->assign("page", $showPage);
        
        
        $this->assign("list",$list);
        $this->display();
    }

    public function edit(){
       if(IS_POST){
         $m_member=M('Member');
         $data=$_POST['info'];
         $uid=$this->_post('uid');
         $sm['email']=$data['email'];
         $sm['uid']=array('neq',$uid);
          
         if($data['pwd']){
             if(strlen($data['pwd'])<6){
                 echo json_encode(array("status" => 0, "info" => "密码少于6位！"));
                 exit;
             }
             $data['pwd']=encrypt( $data['pwd']);
         }else{
             unset($data['pwd']);
         }
        if($uid){
            $map['uid']=$uid;
            if($m_member->where($map)->save($data)){
                echo json_encode(array("status" => 1, "info" => "修改会员成功",'url'=>U('Member/index')));
                exit;
            }else{
                echo json_encode(array("status" => 0, "info" => "修改会员失败"));
                exit;
            }
        }else{
            if(empty($data['pwd'])){
                echo json_encode(array("status" => 0, "info" => "请输入密码！"));
                exit;
            }
            if($m_member->add($data)){
                    echo json_encode(array("status" => 1, "info" => "添加会员成功",'url'=>U('Member/index')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "添加会员失败"));
                    exit;
                }
        }


       }else{
        $uid=$this->_get('uid');
        $m_member=M('Member');
        $map['uid']=$uid;
        $info=$m_member->where($map)->find();
        $this->assign('info',$info);
        $this->display();
       }
    }
    public function del(){
        $uid=$this->_get('uid');
        if(!$uid){return false;}
        $m_member=M('Member');
        $map['uid']=$uid;
        if($m_member->where($map)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}