<?php
class ExamAction extends CommonAction {
	function index(){
		if($this->isPost()){
			$km_id=$this->_post("km_id");
			if(empty($km_id)){
				echo json_encode(array("status" => 0, "info" =>'请选择科目！'));
				exit;
			}
			$exam_name=$this->_post("exam_name");
			if(empty($exam_name)){
				echo json_encode(array("status"=>0,"info"=>"请填写试卷名称！"));
				exit;
			}
			$times=$this->_post("times");
			if(empty($times)){
				echo json_encode(array("status"=>0,"info"=>"请填写考试时长！"));
				exit;
			}
			$score=$this->_post("score");
			if(empty($score)){
				echo json_encode(array("status"=>0,"info"=>"请填写考试分数！"));
				exit;
			}
			$beizhu=$this->_post("beizhu");
			$source=$this->_post("source");
			$admin_id=$_SESSION[C('USER_AUTH_KEY')];
			$admin_name=$_SESSION['username'];
			//获取上传文件的内容
			$content=$this->get_file_content();
			if(empty($content)){
				echo json_encode(array("status"=>0,"info"=>"请上传正确的文本文档！"));
				exit;
			}
			$examMod=D("Exam");
			$data=array(
					"exam_name"=>$exam_name,
					"source"=>$source,
					"admin_id"=>$admin_id,
					"admin_name"=>$admin_name,
					"beizhu"=>$beizhu,
					"times"=>$times,
					"km_id"=>$km_id,
					"add_time"=>time()
					);
			$examMod->add($data);
			$exam_id=$examMod->getLastInsID();
			if($exam_id){
				$content_tm=explode("[page_break]", $content);
				#var_dump($content_tm);
				$qbMod=D("QuestionBig");
				$success=0;
				$error=0;
				foreach ($content_tm as $k=>$v){
					if($v!=""){
						$data=array(
								"eb_content"=>$v,
								"km_id"=>$km_id,
								"add_time"=>time(),
								"admin_id"=>$admin_id,
								"admin_name"=>$admin_name,
								"exam_id"=>$exam_id,
								);
						if($qbMod->add($data)){
							$success++;
						}else{
							$error++;
						}
						
					}
				}
				if(!$error){
					json_encode(array("status"=>0,info=>"有".$error."道题填写失败!"));
					
				}
				if($success){
					json_encode(array("status"=>0,info=>"有".$success."道题填写成功!"));
				}
			}else{
				echo json_encode(array("status"=>0,"info"=>"试卷填写失败！"));exit;
			}
			exit;
			
		}
		//查询科目
		$kmfl_mod=D("Kmfl");
		$list=$kmfl_mod->order("orderid desc ")->select();
		$this->assign("list",$list);
		
		$this->display();
		
	}
	
	function get_content($start,$end,$content){
		$str="";
		for($i=$start;$i<=$end;$i++){
			$str.="<p>".$content[$i]."</p>";
		}
		return $str;
	}
	function get_subject($start,$end,$content){
		$small=$content[$start];
		return $small;
	}
	function get_tra($start,$end,$content){
		$small=$content[$start];
		return $small;
	}
	function get_subject_option($start,$end,$content){
		$k=0;
		for($i=$start+1;$i<=$end;$i++){
			$option[$k]=$content[$i];
			$k++;
		}
		return $option;
	}
	
	
}

?>