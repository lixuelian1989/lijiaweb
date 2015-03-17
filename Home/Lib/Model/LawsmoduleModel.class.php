<?php
class LawsmoduleModel extends Model  {
	function get_list_all($lang=''){
		if(empty($lang))
		$where=array('lang'=>'zh-cn');
		else 
		$where=array('lang'=>$lang);
		
		$list=$this->where($where)->select();
		foreach ($list as $k=>$v){
			$list[$k]['lc_img']=empty($v['lc_img'])?__ROOT__."/Home/Tpl/default/Public/images/fg_07.jpg":__ROOT__."/Uploads/laws/".$v['lc_img'];
			
		}
		return $list;
	}
	
}
?>