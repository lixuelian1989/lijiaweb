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
			$key_start_er=array();
			$key_end_er=array();
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
				if(strstr($v, "[l]")){
					$key_start_er[]=$k;
				}
				if(strstr($v, "[/l]")){
					$key_end_er[]=$k;
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
			$ep_id_list=array();
			$qbMod=D("QuestionBig");
			$qsMod=D("QuestionSmall");
			/* foreach($ep as $k3=>$v3){
				$epMod->data($v3)->add();
				$qbdata[ep_id]=$epMod->getLastInsID();
				$qbdata[eb_content]=$question_big[$k3]['url'];
				
				$qbdata[admin_id]=$exam['admin_id'];
				$qbdata[admin_name]=$exam['admin_name'];
				$qbdata[add_time]=time();
				$qbMod->data($qbdata)->add();
				
				$qb_id=$qbMod->getLastInsID();
				
				$qsdata[qb_id]=$qb_id;
				$qsdata[qs_order]=$k3+1;
				$qsMod->data($qsdata)->add();
			} */
			
			
			
			
			//------------------------------------------写作题end
			
			
			//var_dump($question_big);
			//var_dump($key_start_er);
			//var_dump($key_end_er);
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
				
				
				for($i=$start1;$i<=$end1;$i++){
					if(strstr($content[$i], "[section]"))
						$sectioninfo[$partid]['start'][]=$start1+1;
					if(strstr($content[$i], "[/section]"))
						$sectioninfo[$partid]['end'][]=$start1+1;
					//-----第一行为part信息---第二行为part的direction
					
// 						//只有一道题目的情况
						
// 						//拼凑题目属性
// 						//1、有content的情况 记录content 开始行数 ,结束行数
// 						if(strstr($content[$i],"[content]")){
// 							$part[$k2]['start_hs']=$i+1;	
// 						}
// 						if(strstr($content[$i],"[/content]")){
// 							$part[$k2]['end_hs']=$i-1;
// 						}
// 						//2、有[tra]的情况 开始行数,结束行数
// 						if(strstr($content[$i], "[tra]"))
// 							$part[$k2]['start_hs1'][]=$i+1;
// 						if(strstr($content[$i],"[/tra]"))
// 							$part[$k2]['end_hs1'][]=$i-1;
// 						//3、有[subject]的情况 开始行数,结束行数
// 						if(strstr($content[$i], "[subject]")){
// 							$part[$k2]['start_hs2'][]=$i+1;
// 						}
// 						if(strstr($content[$i], "[/subject]")){
// 							$part[$k2]['end_hs2'][]=$i+1;
// 						}
// 						//4、有[option]的情况 开始行数，结束行数
// 						if(strstr($content[$i], "[option]")){
// 							$part[$k2]['start_hs3'][]=$i+1;
// 						}
// 						if(strstr($content[$i], "[/option]")){
// 							$part[$k2]['end_hs3'][]=$i+1;
// 						}
						
					
						
					
					
					
					
				}
				for($h=$part[$k2]['start_hs'];$h<=$part[$k2]['end_hs'];$h++){
					if(!empty($content[$h]))
						$part[$k2][tm]['eb_content'].="<p>".$content[$h]."</p>";
				}
				
				//有subject的选项
				foreach($part[$k2]['start_hs2'] as $k4=>$v4){
					$part[$k2][tm][$k4]['es_name']= $content[$v4];
					$part[$k2][tm][$k4]['es_option'][0]=$content[$v4+1];
					$part[$k2][tm][$k4]['es_option'][1]=$content[$v4+2];
					$part[$k2][tm][$k4]['es_option'][2]=$content[$v4+3];
					$part[$k2][tm][$k4]['es_option'][3]=$content[$v4+4];
				}
				//有option的选项
				foreach($part[$k2]['start_hs3'] as $k5=>$v5){
					$part[$k2][tm][$k5]['es_name']= $content[$v5];
					$part[$k2][tm][$k5]['es_option'][0]=$content[$v5+1];
					$part[$k2][tm][$k5]['es_option'][1]=$content[$v5+2];
					$part[$k2][tm][$k5]['es_option'][2]=$content[$v5+3];
					$part[$k2][tm][$k5]['es_option'][3]=$content[$v5+4];
				}
				//有tra的选项
				foreach($part[$k2]['start_hs1'] as $k3=>$v3){
				
					for($h=$v3;$h<=$part[$k2]['end_hs1'][$k3];$h++){
						if(!empty($content[$h])){
							//$part[$k2][tm][$k3]['eb_content1']=$content[$h];
							//preg_match_all("//", $subject, $matches);
						}
					}
				}
				
				
				
			}
			
			var_dump($sectioninfo);
			
			
			
			
			exit;
			
		}
		//查询科目
		$kmfl_mod=D("Kmfl");
		$list=$kmfl_mod->order("orderid desc ")->select();
		$this->assign("list",$list);
		
		$this->display();
		
	}
	
	
	
}

?>