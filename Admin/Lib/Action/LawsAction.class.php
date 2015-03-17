<?php

class LawsAction extends CommonAction {

    public function index() {
        $M = M("Laws");
        //过滤
        $s=array('0','1');
        $map=array();
        if($title=$this->_get('title'))$map['l_title']=array('like',"%{$title}%");
        
        if($lt_id=$this->_get('lt_id'))$map['lt_id']=$lt_id;
        if($l_country_id=$this->_get('l_country_id'))$map['l_country_id']=$l_country_id;
        if($module_id=$this->_get('module_id'))$map['module_id']=$module_id;
        if($lt_status=$this->_get('lt_status'))$map['lt_status']=$lt_status;
        
        //
        $count = $M->where($map)->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $this->assign("list", D("Laws")->listLaws($page->firstRow, $page->listRows,$map));

      	//=======================列表
      	$this->get_type();
      	$this->get_country();
      	$this->get_module();
     
      	
        $this->display();
    }
	/**
	 * 法规类型
	 * Enter description here ...
	 */	
    public function lawstype() {
        if (IS_POST) {
            echo json_encode(D("Laws")->lawstype());
        } else {
            $this->assign("list", D("Laws")->lawstype());
            $this->display();
        }
    }
 /**
     * 修改国家
     * Enter description here ...
     * @param unknown_type $img
     */
    public function lawscountryupdate(){
    	if(IS_POST){
    		
    		$lc_name=$_POST['lc_name'];
    		$lang=$_POST['lang'];
    		$lc_id=$_POST['lc_id'];
    		
    		$img='';
	         if($_FILES['imgsrc']['name']){
	         	$dir='./Uploads/laws/'.date('Ym').'/';
	            makeDir($dir);
	            if($image=$this->upload($dir)){
	            	$img=date('Ym').'/'.$image[0]['savename'];
	            }
	            $data['lc_img']=$img;
	         }
	         $data['lc_name']=$lc_name;
    		 $data['lang']=$lang;
    		$where['lc_id']=$lc_id;
    		$lcMod=M('lawscountry');
    		$res=$lcMod->where($where)->save($data);
    		if($res){
    			$this->success("操作成功!");
    			exit;
    		}else{
    			$this->error("操作失败！");
    			exit;
    		}
    		
    		
    	}
    	$lc_id=$_GET['lcid'];
    	
    	$lawsMod=M("lawscountry");
    	$lawsinfo=$lawsMod->where(array('lc_id'=>$lc_id))->find();
    	
    	$this->assign('lawsinfo',$lawsinfo);
    	
    	$this->display();
    }
	/**
	 * 法规颁布国家
	 * Enter description here ...
	 */
    public function lawscountry(){
    	if (IS_POST) {
    		$img='';
	            if($_FILES['imgsrc']['name']){
	                $dir='./Uploads/laws/'.date('Ym').'/';
	                makeDir($dir);
	                if($image=$this->upload($dir)){
	                    $img=date('Ym').'/'.$image[0]['savename'];
	                }
	            }
            echo json_encode(D("Laws")->Lawscountry($img));
            exit;
        } else {
            $this->assign("list", D("Laws")->Lawscountry());
            $this->display();
        }
    	$this->display();
    }
    
    /**
     * 法规 车型
     * Enter description here ...
     */
    public function lawsmodule(){
      	if (IS_POST) {
            echo json_encode(D("Laws")->lawsmodule());
        } else {
            $this->assign("list", D("Laws")->lawsmodule());
            $this->display();
        }
    }
    
    
    
    
    public function add() {
        if (IS_POST) {
           # $this->checkToken();
       		$img='';
       		
            if($_FILES['l_pdf']['name']){
                $dir='./Uploads/pdf/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload_pdf($dir)){
                    $img=date('Ym').'/'.$image[0]['savename'];
                }
            }
            if($_FILES['l_img']['name']){
                $dir='./Uploads/laws/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload($dir)){
                    $fmimg=date('Ym').'/'.$image[0]['savename'];
                }
            }
            
            
            
            $laws_list=D("Laws")->addLaws($img,$fmimg);
           
            if($laws_list['status']==0)
            $this->error($laws_list[info],$laws_list[url]);
            else 
            $this->success($laws_list[info],$laws_list[url]);
        } else {
        	$this->get_date();
        	$this->get_type();
        	$this->get_country();
        	$this->get_module();
        	
            $this->assign("list", D("News")->category());
            $this->display();
        }
    }



    public function edit() {
        $M = M("Laws");
        if (IS_POST) {
           # $this->checkToken();
        	$img='';
            if($_FILES['l_pdf']['name']){
                $dir='./Uploads/pdf/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload_pdf($dir)){
                    $img=date('Ym').'/'.$image[0]['savename'];
                }
            }
            
        	if($_FILES['l_img']['name']){
                $dir='./Uploads/laws/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload($dir)){
                    $fmimg=date('Ym').'/'.$image[0]['savename'];
                }
            }
            
            $laws_list=D("Laws")->edit($img,$fmimg);
            
            
            if($laws_list['status']==0)
            $this->error($laws_list[info],$laws_list[url]);
            else 
            $this->success($laws_list[info],$laws_list[url]);
            
            
            
        } else {
            $info = $M->where("l_id=" . (int) $_GET['id'])->find();
            if ($info['l_id'] == '') {
                $this->error("不存在该记录");
            }
            $let=$info['l_effect_time'];
            $nyrlist=explode('-', $let);
            $info['syear']=$nyrlist[0];
            $info['smonth']=$nyrlist[1];
            $info['sday']=$nyrlist[2];
            
            $this->assign("info", $info);
            $this->get_type();
            $this->get_country();
            $this->get_module();
            $this->get_date();
            $this->display("add");
        }
    }

    public function del() {
        if (M("Laws")->where("l_id=" . (int) $_GET['l_id'])->delete()) {
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        } else {
            echo json_encode(array("status" => 0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }

    public function changeAttr(){
        $id=$this->_get('id');
        $m_news=M("News");
        $map['id']=$id;
        $is_recommend=$m_news->where($map)->getField('is_recommend');
        $data['is_recommend']=abs($is_recommend-1);
        if($m_news->where($map)->save($data)){
            echo json_encode(array("status" => 1, "info" => '<img src="Public/Img/action_'.$data['is_recommend'].'.png" border="0">'));
            exit;
        }
        return false;
    }

    public function changeStatus(){
        $id=$this->_get('id');
        $m_news=M("Laws");
        $map['l_id']=$id;
        $status=$m_news->where($map)->getField('lt_status');
        if($status==1)
        $data['lt_status']=2;
        else
        $data['lt_status']=1;
        $statusArr = array(1=>"生效", 2=>"草案");
        if($m_news->where($map)->save($data)){
            echo json_encode(array("status" => 1, "info" => $statusArr[$data['lt_status']]));
            //echo '<img src="../Public/Img/action_'.$data['is_recommend'].'.png" border="0">';
            exit;
        }
        return false;
    }
    
    /**
     * ========================方法===============================
     */
    private function get_date(){
    	$years=array("2015","2014","2013","2012","2011","2010","2009","2008","2007","2006","2005");
        $months=array("01","02","03","04","05","06","07","08","09","10","11","12");
        $days=array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
        $this->assign('years',$years);
        $this->assign('months',$months);
        $this->assign('days',$days);
    }
    //法规类型
    private function get_type(){
    	$ltMod=M("Lawstype");
    	$lt_list=$ltMod->where(1)->select();
    	$this->assign("lt_list",$lt_list);
    }
    //法规颁布国家
    private function get_country(){
    	$lcMod=M("lawscountry");
    	$lc_list=$lcMod->where(1)->select();
    	$this->assign('lc_list',$lc_list);
    }
    //车型
    private function get_module(){
    	$lmMod=M("lawsmodule");
    	$lm_list=$lmMod->where(1)->select();
    	$this->assign('lm_list',$lm_list);
    }
/**
 * ==============================ajax ==========================
 * 
 */    
    public function checkNewsTitle() {
        $M = M("Laws");
        $where = "title='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And l_id !=" . (int) $_GET['id'];
        }
        if(empty($_GET['title'])){
            echo json_encode(array("status" => 0, "info" => "标题为空"));
        }
        if ($M->where($where)->count() > 0) {
            echo json_encode(array("status" => 0, "info" => "已经存在，请修改标题"));
        } else {
            echo json_encode(array("status" => 1, "info" => "可以使用"));
        }
    }
    public function ajaxget_title(){
    	if(!empty($_REQUEST['lt_id']))
    	$data['lt_id']=$_REQUEST['lt_id'];
    	
    	
    	if(!empty($_REQUEST['l_country_id']))
    	$data['l_country_id']=$_REQUEST['l_country_id'];
    	
    	if(!empty($_REQUEST['module_id']))
    	$data['module_id']=$_REQUEST['module_id'];
    	
    	if(!empty($_REQUEST['lt_status']))
    	$data['lt_status']=$_REQUEST['lt_status'];
    	
    	$lMod=M("Laws");
    	$linfo=$lMod->where($data)->select();
    	
    	echo json_encode($linfo);
    }    

}