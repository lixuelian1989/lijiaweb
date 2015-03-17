<?php

// 本类由系统自动生成，仅供测试用途
class ServicetypeAction extends BaseAction {

    public function index() {
        $this->assign("ad_info", $this->getAd());
        $this->assign('webtitle',L('T_SERVICETYPE'));
		
        $this->display();
    }

}