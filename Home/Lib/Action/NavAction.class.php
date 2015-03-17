<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午9:20
 */
class NavAction extends BaseAction{

    /**
     * 菜单跳转
     */
    public function index(){
        $id=$this->_get('id');
        if(!$id){$this->redirect('index/index');}
        $m_nav=M('Nav');
        $map['id']=$id;
        $info=$m_nav->where($map)->find();
        $module=$info['module'];
        $guide=$info['guide'];
        $map=$guide?array('cid'=>$guide):'';
        switch($module){
            case 'news':
                redirect(U('news/index',$map));
                break;
            case 'product':
                redirect(U('product/index',$map));
                break;
            case 'message':
                redirect(U('message/index'));
                break;
            case 'link':
                redirect($info['link']);
                break;
            case 'page':
                $m_page=M('page');
                $ename=$m_page->where('id='.$guide)->getField('unique_id');
                redirect(U('page/index',array('name'=>$ename)));
                break;
            default:
                redirect(U('index/index'));
                break;
        }

    }



}