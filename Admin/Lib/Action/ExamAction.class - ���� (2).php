<?php
class ExamAction extends CommonAction {
	function index(){
		if($this->isPost()){
			$km_id=$this->_post("km_id");
			if(empty($km_id)){
				echo json_encode(array("status" => 0, "info" =>'请选择科目！'));
				exit;
			}
			//获取上传文件的内容
			$content=$this->get_file_content();
			//var_dump($content);
			$exam=array();
			//$is_sjtitle=preg_match('/^{/', $content[0],$matchs);
			//var_dump(strstr($content[0], "#"));
			$key_start=array();
			$key_end=array();
			$key_start_p1=array();
			$key_end_p1=array();
			foreach ($content as $k=>$v){
				if($k==0){
					$exam['exam_name']=$v;
				}
				if($k==1){
					preg_match('/\d+/', $v,$matchs);
					$exam['score']=$matchs[0];
				}
				if($k==2){
					preg_match('/\d+/', $v,$matchs);
					$exam['times']=$matchs[0];
				}
				if($k==3){
					$exam['beizhu']=$v;
				}
				if(strstr($v,"[w]")){
					$key_start[]=$k;
				}
				if(strstr($v,"[/w]")){
					$key_end[]=$k;
				}
				if(strstr($v, "[P1]")){
					$key_start_p1[]=$k;
				}
				if(strstr($v, "[/P1]")){
					$key_end_p1[]=$k;
				}
				
			//	echo $v."<br>";
			}
			$exam['add_time']=time();
			$exam['km_id']=$km_id;
			$exam['admin_id']=$_SESSION[C('USER_AUTH_KEY')];
			$exam['admin_name']=$_SESSION['username'];
			/* $eMod=D("Exam");
			$eMod->data($exam)->add();
			$exam_id=$eMod->getLastInsID(); */
			$exam_id=1;
			//写作题
			$ep=array();
			$question_big=array();
			foreach($key_start as $k1=>$v1){
				//循环开始
				$start=$v1+1;
				//循环结束
				$end=$key_end[$k1]-1;
				//678
				//preg_match_all('/\d+/',$content[6],$matchs);
			//	var_dump($matchs);
				for($i=$start;$i<=$end;$i++){
					if(strstr($content[$i],"{title}")){
						$ep[$k1]['ep_name']=$content[$i];
						$ep[$k1]['ep_name']=str_replace("{title}","",$ep[$k1]['ep_name']);
					}
					preg_match_all('/\d+/',$content[$start],$matchs);
					//var_dump($matchs);
					$ep[$k1]['ep_time']=$matchs[0][1];
					$ep[$k1]['ep_score']=$matchs[0][2];
					$ep[$k1]['ep_order']=$k1+1;
					if(strstr($content[$i],"{directions}")){
						$ep[$k1]['directions']=$content[$i];
						$ep[$k1]['directions']=str_replace("{directions}","",$ep[$k1]['directions']);
					}
					if(strstr($content[$i],"{url}")){
						$question_big[$k1]['url']=$content[$i];
						$question_big[$k1]['url']=str_replace("{url}","",$question_big[$k1]['url']);
					}
					$ep[$k1]['exam_id']=$exam_id;
				}
			}
			$epMod=D("ExamParts");
			$esMod=D("ExamSections");
			$epaMod=D("ExamPassage");
			$ep_id_list=array();
			$qbMod=D("QuestionBig");
			
			$part=array();
			
			foreach($key_start_er as $k2=>$v2){
				$start1=$v2+1;
				$end1=$key_end_er[$k2]-1;
				preg_match_all('/\d+/',$content[$start1],$matchs);
				if(strstr($content[$start1+1], "Directions"))
					$directions=$content[$start1+1];
				else
					$directions="";
				$data_part=array(
						"exam_id"=>$exam_id,
						"ep_name"=>$content[$start1],
						"ep_time"=>$matchs[0][0],
						"ep_score"=>$matchs[0][1],
						"directions"=>$directions,
						"ep_order"=>$k2+3
						
				);
				$epMod->data($data_part)->add();
				$partid=$epMod->getLastInsID();
				for($i=$v2;$i<=$key_end_er[$k2];$i++){
					//echo $content[$v2+2]."<br/>";
					
					if(strstr($content[$i],"[only]")){
						$qbname=str_replace("[only]", "", $content[$i]);
						preg_match_all('/\d+/',$qbname,$matchs);
					
						$qbMod->add(array("eb_content"=>"",
								"km_id"=>$km_id,
								"ep_id"=>$partid,
								"add_time"=>time(),
								"admin_id"=>$exam[admin_id],
								"admin_name"=>$exam[admin_name]
						));
						$qbid=$qbMod->getLastInsID();
						$qsMod->add(array("qb_id"=>$qbid,"qs_content"=>$qbname));
					}
				}
				
				
				
				//获取section选项-----------行数--------start
				
				for($i=$start1;$i<=$end1;$i++){
					if(strstr($content[$i], "[section]"))
						$sectioninfo[$partid]['start'][]=$i+1;
					if(strstr($content[$i], "[/section]"))
						$sectioninfo[$partid]['end'][]=$i-1;
				}
				//part----------------选项
				
				
			}
			
			//var_dump($sectioninfo);
			//section----------------------------start
			foreach ($sectioninfo as $key=>$val){
				foreach ($val['start'] as $key1=>$val1){
					
					if(strstr($content[$val1+1], "Directions"))
						$directions=$content[$val1+1];
					else
						$directions="";
				    $data2=array(
						"ep_id"=>$key,
						"es_name"=>$content[$val1],
						"directions"=>$directions,
						"es_order"=>$key1+1
						);
					$esMod->data($data2)->add();
					$es_id=$esMod->getLastInsID();
				
				
					for($p=$val1;$p<$val[end][$key1];$p++){
						if(strstr($content[$p], "[passage]"))
							$pass_info[$key][$es_id]['start'][]=$p+1;
						if(strstr($content[$p], "[/passage]"))
							$pass_info[$key][$es_id]['end'][]=$p-1;
					
					}
				
				}
				
				
			}
			//section----------------------------end
			
			foreach($pass_info as $key2=>$val2){
				foreach ($val2 as $key3=>$val3){
					foreach ($val3['start'] as $key4=>$val4){
						if(strstr($content[$val4+1], "Directions"))
							$directions=$content[$val4+1];
						else
							$directions="";
						
						$data3=array(
								"partid"=>$key2,
								"sectionid"=>$key3,
								"epa_name"=>$content[$val4],
								"directions"=>$directions,
								"epa_order"=>$key4
								);
						$epaMod->data($data3)->add();
						$passageid=$epaMod->getLastInsID();
						for ($i=$val4;$i<=$pass_info[$key2][$key3]['end'][$key4];$i++){
							//检查有没有content
							if(strstr($content[$i],"[content]")){
								$start2=$i+1;
							}
							if(strstr($content[$i], "[/content]")){
								$end2=$i-1;
							}
							if($start1!=""){
								for ($h=$start2;$h<=$end2;$h++){
									$tmbigname.=$content[$h];
								}
							}
							
						}	
					}
				}
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
			$str.=$content[$i];
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