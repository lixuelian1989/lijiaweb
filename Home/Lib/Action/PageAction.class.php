<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 上午11:58
 */

class PageAction extends BaseAction {
    /**
     * 显示
     */
    public function index(){
        $name=$this->_get('name');
        if(!$name){$this->redirect('index/index');}
        $map['lang']= $map2['lang']=LANG_SET;
        $map['unique_id']=$name;
        $map['display']=1;
        $m_page=M('page');
        $info=$m_page->where($map)->find();
        $map2['unique_id']=array('neq',$name);
        $map2['display']=1;
        $catlist=$m_page->field('unique_id,page_name')->where($map2)->order('id DESC')->select();
        $this->assign('catlist',$catlist);
        
        $this->assign('info',$info);
        
        $this->assign("ad_info", $this->getAd($name));
        $this->assign('webtitle',$info['page_name']);
//        if($name=='lianxiwomen'){
//        	$this->display("lianxiwomen");
//        	exit;
//        }
//        if($name=='hezuofangshi'){
//        	$this->display("hezuofangshi");
//        	exit;
//        }
        $this->display($name);
    }


} 