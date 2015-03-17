<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-10
 * Time: 上午10:35
 */
class MessageAction extends BaseAction{

    public function index(){
      if(IS_POST){
        $m_message=M('message');
        $data['username']=$this->_post('txtname');
        $data['monlie']=$this->_post('txttel');
        $data['email']=$this->_post('txteml');
        $data['content']=$this->_post('txtenqdetail');
        $data['addtime']=time();
        if(!$m_message->autoCheckToken($_POST)){
            die('操作错误');
        }
        if($m_message->add($data)){
            $this->assign('showtext',1);
        }
      }
      $this->display();
    }

}