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
					$key_start_p1=$k;
				}
				if(strstr($v, "[/P1]")){
					$key_end_p1=$k;
				}
				if(strstr($v, "[P2]")){
					$key_start_p2=$k;
				}
				if(strstr($v, "[/P2]")){
					$key_end_p2=$k;
				}
				if(strstr($v, "[P3]")){
					$key_start_p3=$k;
				}
				if(strstr($v, "[/P3]")){
					$key_end_p3=$k;
				}
				if(strstr($v, "[P4]")){
					$key_start_p4=$k;
				}
				if(strstr($v, "[/P4]")){
					$key_end_p4=$k;
				}
				if(strstr($v, "[P5]")){
					$key_start_p5=$k;
				}
				if(strstr($v, "[/P5]")){
					$key_end_p5=$k;
				}
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
			unset($ep);
			unset($question_big);
			//写作题==============end
			$epMod=D("ExamParts");
			$esMod=D("ExamSections");
			$epaMod=D("ExamPassage");
			$qbMod=D("QuestionBig");
			$qsMod=D("QuestionSmall");
			$qoMod=D("QuestionOption");
			//var_dump($key_start_p1);
			//第二部分阅读题
			preg_match_all('/\d+/', $content[$key_start_p1+1],$matchs1);
			
			$epMod->add(array(
					"exam_id"=>$exam_id,
					"ep_name"=>$content[$key_start_p1+1],
					"ep_time"=>$matchs1[0][0],
					"ep_score"=>$matchs1[0][1],
					"ep_order"=>3,
					"directions"=>$content[$key_start_p1+2]
					));
			
			$ep_id1=$epMod->getLastInsID();
			
			
			$qb_subject_h_s=array();
			$qb_subject_h_e=array();
			 for ($i=$key_start_p1+1;$i<=$key_end_p1;$i++){
				if(strstr($content[$i],"[content]"))
					$qb_title_h_s=$i+1;
				if(strstr($content[$i],"[/content]"))
					$qb_title_h_e=$i-1;
				if(strstr($content[$i], "[subject]"))
					$qb_subject_h_s[]=$i+1;
				if(strstr($content[$i], "[/subject]"))
					$qb_subject_h_e[]=$i-1;
				if(strstr($content[$i], "[tra]"))
					$qb_tra_h_s[]=$i+1;
				if(strstr($content[$i], "[/tra]"))
					$qb_tra_h_e[]=$i-1;
				
			} 
			$qbtitle1=$this->get_content($qb_title_h_s, $qb_title_h_e, $content);
			$data=array(
					"eb_content"=>$qbtitle1,
					"km_id"=>$km_id,
					"ep_id"=>$ep_id1,
					"add_time"=>time(),
					"admin_name"=>$exam['admin_name'],
					"admin_id"=>$exam['admin_id']
					);
			
			$qbMod->add($data);
			$qb_id1=$qbMod->getLastInsID();
			$orders1=1;
			foreach($qb_subject_h_s as $key1=>$val1){
				$subject_name=$content[$val1];
				$data1=array(
						"qb_id"=>$qb_id1,
						"qs_content"=>$subject_name,
						"qs_order"=>$orders1,		
						 );
				//var_dump($data1);
				$qsMod->add($data1);
				$qs_id1=$qsMod->getLastInsID();
				$option_s[$qs_id1]=$val1+1;
				$option_e[$qs_id1]=$qb_subject_h_e[$key1];
				//echo ($val1+1)."<br/>";
				//echo $qb_subject_h_e[$key1]."<ss>";
				$orders1++;
			}
			
			
			foreach ($option_s as $k=>$v){
				$orders=1;
				for($is=$v;$is<=$option_e[$k];$is++){
					$data=array(
							"qb_id"=>$qb_id1,
							"qs_id"=>$k,
							"option_name"=>$content[$is],
							"option_order"=>$orders,
							);
					
					$qoMod->add($data);
					$orders++;
				}
				
			}
			
			for($i=$qb_tra_h_s;$i<=$qb_tra_h_e;$i++){
				$data=array(
						"qb_id"=>$qb_id1,
						"qs_content"=>$subject_name,
						"qs_order"=>$orders1,
						);
				$orders1++;
				$qsMod->add($data);
			}
			
			
			//end
			$listening_s=$key_start_p2+1;
			$listening_e=$key_end_p2-1;
			//1、向数据库part中添加并获取partid
			preg_match_all('/\d+/', $content[$listening_s],$matchs2);
			$data=array(
					"exam_id"=>$exam_id,
					"ep_name"=>$content[$listening_s],
					"ep_time"=>$matchs2[0][0],
					"ep_score"=>$matchs2[0][1],
					"ep_order"=>3,
					"directions"=>$content[$listening_s+1]
			);
			
			$epMod->add($data);
			
			$ep_id2=$epMod->getLastInsID();
			//2、循环获取section 的起始 行数和结束行数
			$s_hs=array();
			$e_hs=array();
			for($i=$listening_s;$i<=$listening_e;$i++){
				if(strstr($content[$i], "[section]"))
					$s_hs[$ep_id2][]=$i+1;
				if(strstr($content[$i], "[/section]"))
					$e_hs[$ep_id2][]=$i-1;
			}
			//3、用section的起始行数和结束行数作为循环的基数 循环向 数据库section中添加 并获取 sectionid
			$sp_hs=array();
			$ep_hs=array();
			foreach($s_hs as $k=>$v){
				foreach($v as $k1=>$v1){
					if(strstr($content[$v1+1], "Directions")){
						$direction=$content[$v1+1];
					}
					$data2=array(
							"ep_id"=>$k,
							"es_name"=>$content[$v1],
							"es_order"=>$k1,
							"directions"=>$direction
					);
					$esMod->add($data2);
					$es_id=$esMod->getLastInsID();
					//4、循环获取passage的起始行数和结束行数
					for ($i=$v1;$i<=$e_hs[$k][$k1];$i++){
						if(strstr($content[$i],"[passage]"))
							$sp_hs[$es_id][]=$i+1;
			
						if(strstr($content[$i],"[/passage]"))
							$ep_hs[$es_id][]=$i-1;
			
			
					}
			
			
				}
			
			}
			
			//5、用passage的起始行数和结束行数作为基数向数据库中导入passage的信息
			$option_hs_end=array();
			$option_hs_start=array();
			
			foreach($sp_hs as $keys1=>$value1){
				foreach ($value1 as $keys2=>$value2){
					$data3=array(
							"partid"=>$ep_id2,
							"sectionid"=>$keys1,
							"epa_name"=>$content[$value2],
							"epa_order"=>$keys2,
			
					);
					$epaMod->add($data3);
					$epa_id2=$epaMod->getLastInsID();
					//6、插入听力题目
					$data4=array(
							"eb_content"=>"听力题目：",
							"biaoqian"=>"听力",
							"km_id"=>$km_id,
							"ep_id"=>$ep_id2,
							"es_id"=>$keys1,
							"epa_id"=>$epa_id2,
							"add_time"=>time(),
							"admin_id"=>$exam['admin_id'],
							"admin_name"=>$exam['admin_name']
					);
					$qbMod->add($data4);
					$qb_id2=$qbMod->getLastInsID();
					//7、循环获取option 的开始记录和结束记录
					for ($i=$value2;$i<=$ep_hs[$keys1][$keys2];$i++){
						if(strstr($content[$i], "[options]"))
							$option_hs_start[$qb_id2][]=$i+1;
						if(strstr($content[$i], "[/options]"))
							$option_hs_end[$qb_id2][]=$i-1;
			
					}
				}
			}
			//以option选项为基数进行添加小题标号
			foreach ($option_hs_start as $keys3=>$value3){
				$qb_id2=$keys3;
				foreach ($value3 as $keys4=>$value4){
					$data5=array(
							"qb_id"=>$qb_id2,
							"qs_title"=>$content[$value4],
							"qs_content"=>"听力"
					);
					$qsMod->add($data5);
					$qs_id2=$qsMod->getLastInsID();
					//9、循环插入option
					for ($i=$value4+1;$i<=$option_hs_end[$qb_id2][$keys4];$i++){
						$data6=array(
								"qb_id"=>$qb_id2,
								"qs_id"=>$qs_id2,
								"option_name"=>$content[$i],
								"option_order"=>$keys4,
						);
						$qoMod->add($data6);
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