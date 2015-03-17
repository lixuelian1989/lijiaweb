<?php

class LawsModel extends Model {

    public function listNews($firstRow = 0, $listRows = 20,$map) {
        $M = M("News");
        $list = $M->field("`id`,`title`,`status`,`published`,`cid`,`aid`,`is_recommend`,`lang`")->where($map)->order("`published` DESC")->limit("$firstRow , $listRows")->select();
        $statusArr = array("待审核", "已发布");
        $aidArr = M("Admin")->field("`aid`,`email`,`nickname`")->select();
        foreach ($aidArr as $k => $v) {
            $aids[$v['aid']] = $v;
        }
        unset($aidArr);
        $map['type']='n';
        $cidArr = M("Category")->field("`cid`,`name`")->where($map)->select();
        foreach ($cidArr as $k => $v) {
            $cids[$v['cid']] = $v;
        }
        unset($cidArr);
        foreach ($list as $k => $v) {
            $list[$k]['aidName'] =$aids[$v['aid']]['nickname'] == '' ? $aids[$v['aid']]['email'] : $aids[$v['aid']]['nickname'];
            $list[$k]['status'] = $statusArr[$v['status']];
            $list[$k]['cidName'] = $cids[$v['cid']]['name'];
        }
        return $list;
    }
	/**
	 * 法规分类
	 * Enter description here ...
	 */
    public function lawstype() {
        if (IS_POST) {
            $act = $_POST[act];
            $data = $_POST['data'];
            $data['lt_name'] = addslashes($data['lt_name']);
           # $data['lt_time']=time();
            $M = M("Lawstype");
            if ($act == "add") { //添加分类
                unset($data[lt_id]);
                #$data['type']= $_POST['type'];
                if ($M->where($data)->count() == 0) {
                    return ($M->add($data)) ? array('status' => 1, 'info' => '分类 ' . $data['lt_name'] . ' 已经成功添加到系统中', 'url' => U('laws/lawstype', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['lt_name'] . ' 添加失败');
                } else {
                    return array('status' => 0, 'info' => '系统中已经存在分类' . $data['lt_name']);
                }
            } else if ($act == "edit") { //修改分类
                if (empty($data['lt_name'])) {
                    unset($data['lt_name']);
                }
                if ($data['pid'] == $data['lt_id']) {
                    unset($data['pid']);
                }
                return ($M->save($data)) ? array('status' => 1, 'info' => '分类 ' . $data['lt_name'] . ' 已经成功更新', 'url' => U('laws/lawstype', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['lt_name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset($data['pid'], $data['lt_name']);

                if($M->where('pid='.$data['lt_id'].' AND cid!='.$data['lt_id'])->count()>0){
                    return (array('status' => 0, 'info' => $data['lt_name'] . '存在下级分类，请先删除'));
                    exit;
                }

                return ($M->where($data)->delete()) ? array('status' => 1, 'info' => '分类 ' . $data['lt_name'] . ' 已经成功删除', 'url' => U('laws/lawstype', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['lt_name'] . ' 删除失败');
            }
        } else {
            import("Category");
           // $map['type']='n';
            $cat = new Category('Lawstype', array('lt_id', 'pid', 'lt_name', 'fullname'),$map);
            return $cat->getList();               //获取分类结构
        }
    }
	
    
    /**
     * 车型
     */
    public function lawsmodule() {
        if (IS_POST) {
            $act = $_POST[act];
            $data = $_POST['data'];
            $data['lm_name'] = addslashes($data['lm_name']);
           # $data['lt_time']=time();
            $M = M("Lawsmodule");
            if ($act == "add") { //添加分类
                unset($data[lm_id]);
                #$data['type']= $_POST['type'];
                if ($M->where($data)->count() == 0) {
                    return ($M->add($data)) ? array('status' => 1, 'info' => '车型 ' . $data['lm_name'] . ' 已经成功添加到系统中', 'url' => U('laws/lawsmodule', array('time' => time()))) : array('status' => 0, 'info' => '车型 ' . $data['lm_name'] . ' 添加失败');
                } else {
                    return array('status' => 0, 'info' => '系统中已经存在车型' . $data['lm_name']);
                }
            } else if ($act == "edit") { //修改分类
                if (empty($data['lm_name'])) {
                    unset($data['lm_name']);
                }
                
                return ($M->save($data)) ? array('status' => 1, 'info' => '车型 ' . $data['lm_name'] . ' 已经成功更新', 'url' => U('laws/lawsmodule', array('time' => time()))) : array('status' => 0, 'info' => '车型 ' . $data['lm_name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset($data['lm_name']);
                	
                return ($M->where($data)->delete()) ? array('status' => 1, 'info' => '车型 ' . $data['lm_name'] . ' 已经成功删除', 'url' => U('laws/lawsmodule', array('time' => time()))) : array('status' => 0, 'info' => '车型' . $data['lm_name'] . ' 删除失败');
            }
        } else {
         	  $lmMod=M("Lawsmodule");
        	  return $lmMod->where(1)->select();
        }
    }
	
    
    /**
     * 法规颁布国家
     * Enter description here ...
     * @param unknown_type $img
     */
    public function Lawscountry($img=''){
    	
    	if (IS_POST) {
    		
            $act = $_POST[act];
            $data = $_POST['data'];
            $data['lc_name'] = addslashes($data['lc_name']);
            
            #$data['add_time']=time();
            
            $M = M("Lawscountry");
            if ($act == "add") { //添加国家
                unset($data[lt_id]);
	            
                $data['lc_img']=$img;
              
                if ($M->where($data)->count() == 0) {
                    return ($M->add($data)) ? array('status' => 1, 'info' => '国家 ' . $data['lc_name'] . ' 已经成功添加到系统中', 'url' => U('laws/Lawscountry', array('time' => time()))) : array('status' => 0, 'info' => '国家 ' . $data['lc_name'] . ' 添加失败');
                } else {
                    return array('status' => 0, 'info' => '系统中已经存在国家' . $data['lc_name']);
                }
            } else if ($act == "edit") { //修改分类
                if (empty($data['lc_name'])) {
                    unset($data['lc_name']);
                }
              
                return ($M->save($data)) ? array('status' => 1, 'info' => '分类 ' . $data['lt_name'] . ' 已经成功更新', 'url' => U('laws/lawstype', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['lt_name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset( $data['lc_name']);
                #var_dump($data);
                return ($M->where($data)->delete()) ? array('status' => 1, 'info' => '国家 ' . $data['lc_name'] . ' 已经成功删除', 'url' => U('laws/lawstype', array('time' => time()))) : array('status' => 0, 'info' => '国家 ' . $data['lc_name'] . ' 删除失败');
            }
        } else {
           	$lcMod=M("Lawscountry");
           	$list=$lcMod->where("1")->select();
            return $list;               //获取分类结构
        }
    	
    }
   
    
    public function addLaws($img,$fmimg) {
        $M = M("Laws");
        $data = $_POST['info'];
        $data['l_title']=strip_tags($data['l_title']);
        $data['add_time'] = time();
        
        if(empty($data['l_title'])){
            return array('status' => 0, 'info' => "请输入标题！",'url'=>__SELF__);
            
        }
        if($this->check_laws_title($data['l_title'])){
        	return array('status' => 0, 'info' => "该标题已经在数据库中存在！",'url'=>__SELF__);
        	exit;
        }
        $data['l_pdf']=$img;
        $data['l_img']=$fmimg;
        
        $data['l_effect_time']=$_POST['sx_year']."-".$_POST['sx_months']."-".$_POST['sx_day'];
        $data['aid']=$_SESSION['my_info']['aid'];
        if ($M->add($data)) {
            return array('status' => 1, 'info' => "已经发布", 'url' => U('Laws/index'));
        } else {
            return array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作");
        }
    }
    public function check_laws_title($title){
    	return $this->where(array('l_title'=>$title))->count();
    	
    }

    public function edit($img,$fmimg) {
        $M = M("Laws");
        $data = $_POST['info'];
        $data['l_title']=strip_tags($data['l_title']);
        $data['add_time'] = time();
        if(!empty($img))
        $data['l_pdf']=$img;
        
        if(!empty($fmimg))
        $data['l_img']=$fmimg;
        
        
        
        $data['l_effect_time']=$_POST['sx_year']."-".$_POST['sx_months']."-".$_POST['sx_day'];
        
        if(empty($data['l_title'])){
            return array('status' => 0, 'info' => "请输入标题！",'url'=>__SELF__);
        }
        if ($M->save($data)) {
            return array('status' => 1, 'info' => "已经更新", 'url' => U('Laws/index'));
        } else {
            return array('status' => 0, 'info' => "更新失败，请刷新页面尝试操作");
        }
    }
    public function listLaws($firstRow, $listRows,$map){
    	
    	$aidArr = M("Admin")->field("`aid`,`email`,`nickname`")->select();
        foreach ($aidArr as $k => $v) {
            $aids[$v['aid']] = $v;
        }
        unset($aidArr);
        
    	
    	$list=$this->where($map)->order("`add_time` DESC")->limit($firstRow,$listRows)->select();
    	$status_arr=array(1=>"生效",2=>"草案");
    	foreach ($list as $K=>$v){
    		$list[$K]['aidName'] =$aids[$v['aid']]['nickname'] == '' ? $aids[$v['aid']]['email'] : $aids[$v['aid']]['nickname'];
    		$list[$K]['status']=$status_arr[$v['lt_status']];
    		if(!empty($v['lt_id'])){
    			$rs=M('lawstype')->where(array('lt_id'=>$v['lt_id']))->find();
    			$list[$K]['lt_name']=$rs['lt_name'];
    		}
    		
    	}
    	return $list;
    }

}

?>
