<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-10
 * Time: 上午9:23
 */
class IndexAction extends BaseAction {

    public function index(){
        $m_product=M('product');
        $map['lang']=LANG_SET;
        //$map['wap_display']=1;
        $product_list=$m_product->where($map)->limit(10)->order('id DESC')->select();
        $this->assign('plist',$product_list);
        $this->display();
    }
}