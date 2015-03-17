<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-11-10
 * Time: 上午9:27
 */
class BaseAction extends Action{


    public function  _initialize(){
        $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
        $this->assign("site", $systemConfig);
        $this->assign('adlist',$this->getAd());
    }

    protected function getAd(){
        $m_ad=M('ad');
        $map['lang']=LANG_SET;
        $map['position']='wap';
        $list=$m_ad->where($map)->limit(10)->order('id DESC')->select();
        return  $list;
    }


}