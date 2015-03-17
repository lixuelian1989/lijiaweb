<?php
class lawstypeModel extends Model  {
	
	function get_list_all($lang=''){
		if(empty($lang))
		$where=array('lang'=>'zh-cn');
		else 
		$where=array('lang'=>$lang);
		
		$list=$this->where($where)->select();
		
		return $list;
	}
	
}
?>