<?php

class KmflAction extends CommonAction {
	/* 列表 */
	public function index(){
		$kmfl=D("Kmfl");
		$map=array("status"=>"1","sj_id"=>"0");
		$count=$kmfl->where($map)->count();
		import("ORG.Util.Page");
		$page=new Page($count,12);
		$showPage=$page->show();
		
		$list=$kmfl->order('orderid desc')->where($map)->limit("$page->firstRow, $page->listRows")->select();
		#echo $kmfl->getLastSql();
		$this->assign("page", $showPage);
		$this->assign("list",$list);
		#var_dump($list);
		$this->display();
	}
	/* 更改排序 */
	public function update_orderid(){
		$id=$this->_get("id");
		
	}
}

?>