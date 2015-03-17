<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-10
 * Time: 上午10:33
 */
class ProductAction extends BaseAction{


    public function index(){
       $m_product=M('product');
       $map['lang']=LANG_SET;
       $map['wap_display']=1;
       $wap_product=$m_product->where($map)->limit(10)->order('id DESC')->select();
        $this->assign('wap_p_list',$wap_product);
       $this->display();
    }

}