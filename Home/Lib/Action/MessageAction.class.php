<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午12:14
 */

class MessageAction extends BaseAction {

    public function _initialize(){
        parent::_initialize();
       $if_open=C('TOKEN.mess_on');
        if($if_open!=1){
           $this->error('留言板已关闭！',U('index/index'));
        }
    }
    /**
     * 显示页
     */
    public function index(){
        $m_page=M('page');
        $map2['display']=1;
        $map2['lang']=LANG_SET;
        $catlist=$m_page->field('unique_id,page_name')->where($map2)->order('id DESC')->select();
        $this->assign('catlist',$catlist);
        $this->assign("ad_info", $this->getAd());
        $this->assign('webtitle',L('T_MESSAGE'));
        $this->display();
    }
    /**
     * 提交页
     */
    public function add(){
        import('ORG.Util.Input');
        if ($_SESSION['verify'] != md5($_POST['verify_code'])) {
            $this->error('验证码错误啦，再输入吧');
        }
        if (IS_POST) {
            if (!M("Admin")->autoCheckToken($_POST)) {
                $this->error('令牌验证失败');
            }
            unset($_POST[C("TOKEN_NAME")]);
        }
        $data['username']=$this->_post('username');
        $data['email']=$this->_post('email');
        $data['moblie']=$this->_post('moblie');
        $data['addtime']=time();
        $data['content']=Input::deleteHtmlTags($_POST['content']);
        $message=M('message');
        if($message->add($data)){
            if(IS_AJAX)
            echo   json_encode(array('status' => 1, 'info' => '留言成功！'));
            else
                $this->success('留言成功');
        }else{
            if(IS_AJAX)
            echo   json_encode(array('status' =>0, 'info' => '留言失败！'));
            else
                $this->error('留言失败');
        }
    }
} 