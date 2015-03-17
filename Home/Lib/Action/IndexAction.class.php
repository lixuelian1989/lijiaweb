<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends BaseAction {

    public function index() {
        $this->assign("ad_info", $this->getAd());
        $this->assign('webtitle',L('T_HOME'));
	
        $this->display();
    }

}