<?php
/**
 +------------------------------------------------------------------------------
 * 边走边听接口
 +------------------------------------------------------------------------------
 * @category   Action
 * @package  Lib
 * @subpackage  Action
 * @author   yangshuai <ysainjh@163.com>
 * @version  $Id: MemberAction.class.php 2791 2013/12/10  yangshuai $
 +------------------------------------------------------------------------------
 */
class MemberAction extends CommonAction {
	
	//首页最新景区
	public function newscenic($field){
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="fail";
		$this->response->body->field="[]";
		$this->response->head->res_arg='';
		$s_model=D('Scenic');
		$scenics=array();
		$scenics=$s_model->field('`id`,`sce_name`,`sce_img`,`sce_adimg`,`url`')->where(array('status'=>'1','url'=>array('neq','')))->limit(5)->order('sce_upload_time desc')->select();
		if(count($scenics)<5)
		{
			$scenics1=$s_model->field('`id`,`sce_name`,`sce_img`,`sce_adimg`,`url`')->where(array('status'=>'1','url'=>array('eq','')))->limit(5-count($scenics))->order('sce_upload_time desc')->select();
			if(!empty($scenics1)){
				if(!empty($scenics)){
					$scenics=array_merge($scenics,$scenics1);
				}else{
					$scenics=$scenics1;
				}
			}
		}
		if(!empty($scenics))
		{
			foreach ($scenics as $k=>$v){
				$scenics[$k]['sce_img']=!empty($v['sce_adimg'])?SITE_URL.$v['sce_adimg']:SITE_URL.$v['sce_img'];
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$scenics;
		}
		$this->ajaxReturn($this->response);
	
	}
	 //最新景区    按照上传时间排序  没有请求参数
	 public function newest($field){
	 	
	 	$this->response->head->res_code="0001";
	 	$this->response->head->res_msg="没有最新景区";
	 	$this->response->body->field="[]";
	 	$this->response->head->res_arg='';
	 	
	 	$s_model=D('Scenic');
	 	$scenics=$s_model->field('`id`,`sce_name`,`sce_img`')->where(array('status'=>'1'))->order('sce_upload_time desc')->select();
	 	if(!empty($scenics)){
	 		foreach ($scenics as $k=>$v){
	 			$scenics[$k]['sce_img']=empty($v['sce_img'])?'':SITE_URL.$v['sce_img'];
	 		}
	 		$this->response->head->res_code="0000";
	 		$this->response->head->res_msg="success";
	 		$this->response->body->field=$scenics;
	 	}
	 	$this->ajaxReturn($this->response);
	 }
	//返回所有景区接口
	public function allscenic($field){
			
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="fail";
		$this->response->body->field="[]";
		$this->response->head->res_arg='';
	
		$s_model=D('Scenic');
		$scenics=$s_model->field('`id`,`sce_name`,`sce_longitude`,`sce_latitude`')->where(array('status'=>'1'))->order('sce_upload_time desc')->select();
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$scenics;
		$this->ajaxReturn($this->response);
	}
	//根据关键字   搜索景区
	public function search($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
	
		$sce_name=$request->sce_name;
		//返回请求参数
		$this->response->head->res_arg=empty($sce_name)?'':$sce_name;
	
		$sce_name=htmlspecialchars(addslashes(trim($sce_name)));
		// 多个关键字 按照空格拆分关键字
		$names=explode(" ",$sce_name);
		$map=array();
		foreach ($names as $v){
			$map[]='%'.$v.'%';
		}
		$s_model=D('Scenic');
		$scenics=$s_model->field('`id`,`sce_name`,`sce_img`,`sce_detail`,`sce_count`,`sce_grade`')->where(array('status'=>'1','sce_name'=>array('LIKE',$map,'OR')))->order('sce_upload_time desc')->select();
		if(!empty($scenics)){
			foreach ($scenics as $k=>$v){
				$scenics[$k]['sce_img']=empty($v['sce_img'])?'':SITE_URL.$v['sce_img'];
				$scenics[$k]['sce_detail']=empty($v['sce_detail'])?'':msubstr($v['sce_detail'], $start=0, 20, $charset="utf-8", $suffix=true);
			}
			
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$scenics;
		}
		$this->ajaxReturn($this->response);
	}
	
	//返回所有地区的接口
	public function city($field){
		import('ORG.Net.City');
		$citys = new City();
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->head->res_arg="";
		$this->response->body->field=json_decode($citys->city);
	
		$this->ajaxReturn($this->response);
	}
	//根据区域搜索景区
	public function area($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
		
		//区域
		$zone=$request->zone;
		$sce_name=$request->sce_name;
		//返回请求参数
		$this->response->head->res_arg=empty($sce_name)?'':$sce_name;
		
		$sce_name=htmlspecialchars(addslashes(trim($sce_name)));
		$zone=htmlspecialchars(addslashes(trim($zone)));
		//多个关键字 按照空格拆分关键字
		$names=explode(" ",$sce_name);
		$map=array();
		foreach ($names as $v){
			$map[]='%'.$v.'%';
		}
		$data['sce_name']=array('LIKE',$map,'OR');
		$data['status']=1;
		//$data['_string']="(`sce_city` like '%".$zone."%') OR (`sce_name` like '%".$zone."%') OR (`sce_address` like '%".$zone."%') OR (`sce_province` like '%".$zone."%')";
		$data['_string']="(`sce_province` like '%".$zone."%')";
		$s_model=D('Scenic');
		$scenics=$s_model->field('`id`,`sce_name`,`sce_img`,`sce_count`,`sce_detail`,`sce_grade`,`sce_longitude`,`sce_latitude`')->where($data)->order('sce_count desc')->select();
		if(!empty($scenics)){
			foreach ($scenics as $k=>$v){
				$scenics[$k]['sce_img']=empty($v['sce_img'])?'':SITE_URL.$v['sce_img'];
				$scenics[$k]['sce_detail']=empty($v['sce_detail'])?'':msubstr($v['sce_detail'], $start=0, 20, $charset="utf-8", $suffix=true);
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$scenics;
		}
		
		$this->ajaxReturn($this->response);
	}
//收听某个景区/景点   根据景区/景点id 
	public function listen($field){
		$request=json_decode($field);
		$this->response->head->res_code="00012";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg=$request->view_id;
		$this->response->body->field="[]";
		//景区id
		$id=$request->id;
		$uid=$request->uid;
		//收听景区
		if($id){
			$s_model=D('Scenic');
			$scenics=$s_model->field('id,sce_voice,sce_voice_info,sce_detail,sce_famous,sce_product,sce_images')->find($id);
			if(!empty($scenics)){
				//点击收听 景区收听次数+1
				$s_model->where('id='.$id)->setInc('sce_count');
				//插入我的足迹表
				if(!D('Log')->where(array('uid'=>$uid,'sce_id'=>$id))->find())
					//保存
					D('Log')->add(array('uid'=>$uid,'sce_id'=>$id));
				if(!empty($scenics['sce_images']))
				{
					$imgs=D('SceImg')->query("SELECT CONCAT('".SITE_URL."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".$scenics['sce_images'].")");
					$scenics['sce_images']=$imgs;
				}
				$scenics['sce_voice']=empty($scenics['sce_voice'])?'':SITE_URL.$scenics['sce_voice'];
				$scenics['sce_voice_info']=empty($scenics['sce_voice_info'])?'':SITE_URL.$scenics['sce_voice_info'];
				$scenics['sce_detail']=empty($scenics['sce_detail'])?'':$scenics['sce_detail'];
				$scenics['sce_famous']=empty($scenics['sce_famous'])?'':$scenics['sce_famous'];
				$scenics['sce_product']=empty($scenics['sce_product'])?'':$scenics['sce_product'];
					
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$scenics;
			}
		}
		//收听景点
		//景点id

      $view_id=$request->view_id;
		if($view_id){
			$v_model=D('View');

            $where=array();
			$where["id"]=$view_id;				
			$views=$v_model->where($where)->find();

			if(!empty($views)){
				//点击收听 景区收听次数+1
				$v_model->where('id='.$id)->setInc('view_count');
				//插入我的足迹表
				if(!D('Log')->where(array('uid'=>$uid,'sce_id'=>$views['sec_id']))->find())
					//保存
					D('Log')->add(array('uid'=>$uid,'sce_id'=>$views['sec_id']));
				
				$views['sce_voice']=empty($views['view_voice'])?'':SITE_URL.$views['view_voice'];
			    $views['sce_voice_info']=empty($views['view_voice_info'])?'':SITE_URL.$views['view_voice_info'];
				$views['sce_detail']=empty($views['view_detail'])?'':$views['view_detail']; 
				$views['sce_famous']=empty($views['view_famous'])?'':$views['view_famous'];
				$views['sce_product']=empty($views['view_product'])?'':$views['view_product'];
				if(!empty($views['sce_images']))
				{
					$imgs=D('SceImg')->query("SELECT CONCAT('".SITE_URL."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".$views['sce_images'].")");
					$views['sce_images']=$imgs;
				}
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
		        $this->response->body->field=$views;
				
			}
		}
		

		$this->ajaxReturn($this->response);
	}
	//根据景区id返回景区相关信息
	public function sceinfo($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		
		$this->response->body->field="[]";
		//景区id
		$id=$request->id;
		
		$s_model=D('Scenic');
		$type=$request->type;
		
		$type=empty($type)?'sce_detail':$type;
		//传参
		$this->response->head->res_arg=$type;
		if($type=="sce_tips")$type="sce_line,sce_price";
		
		$scenics=$s_model->field('id,sce_name,sce_img,sce_count,'.$type)->find($id);
		if(!empty($scenics)){
			if(!empty($scenics['sce_images'])){
				$imgs=D('SceImg')->query("SELECT CONCAT('".SITE_URL."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".$scenics['sce_images'].")");
				$scenics['sce_images']=$imgs;
			}
			$scenics['sce_img']=empty($scenics['sce_img'])?'':SITE_URL.$scenics['sce_img'];
			if($request->type=="sce_tips"){
				$scenics['sce_line']=empty($scenics['sce_line'])?'':$scenics['sce_line'];
				$scenics['sce_price']=empty($scenics['sce_price'])?'':$scenics['sce_price'];
				$scenics[$request->type]=array('sce_line'=>$scenics['sce_line'],'sce_price'=>$scenics['sce_price']);
				unset($scenics['sce_line']);
				unset($scenics['sce_price']);
			}else{
				$scenics[$request->type]=empty($scenics[$type])?'':$scenics[$type];
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$scenics;
		}
		$this->ajaxReturn($this->response);
	}
	//根据景区id查看景区地图
	public function scemap($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		//景区id
		$id=$request->id;
		$id=intval($id);
		$s_model=D('Scenic');
		//关联景区地图查看景点的坐标位置，景点名称，。。。。
		$scenics=$s_model->field('id,sce_map')->relation(true)->find($id);
		if(!empty($scenics)){
			$scenics['sce_map']=empty($scenics['sce_map'])?'':SITE_URL.$scenics['sce_map'];
			$scenics['views']=empty($scenics['views'])?'':$scenics['views'];
			//$scenics['views']=$s_model->getlastsql();
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$scenics;
		}
		$this->ajaxReturn($this->response);
	}
	//景区评论
	public function scecomment($field){
		
		$request=json_decode($field);
		$sce_id=$request->sceid;
		$uid=$request->uid;
		$content=$request->content;
		$imgarr=$request->photo;
	
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		if(!empty($imgarr))
		{
			$photo="";
			foreach ($imgarr as $key => $val)
			{
				$img = base64_decode($val);
				$im = imagecreatefromstring($img);
				header('Content-Type: image/png');
				$filename=time().rand(1, 100).".png";
				mkdir(UPLOAD_PATH.'comment');
				imagepng($im,UPLOAD_PATH.'comment/'.$filename);
	
				$arr['imgurl']='comment/'.$filename;
				imagedestroy($im);
				$res=D('SceImg')->add($arr);
				$photo=$photo.$res.",";
			}
			$data['images']=$photo;
		}
		$data['time']=time();
		$data['sce_id']=$sce_id;
		$data['uid']=$uid;
		$data['content']=htmlspecialchars(trim($content));
		if(empty($data['content'])&&empty($data['images'])){
			$this->response->head->res_msg="评论内容不能为空";
			$this->ajaxReturn($this->response);
			exit;
		}
		$res=D('SceComment')->add($data);
// 		echo D('SceComment')->getLastSql();
		if($res){
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
		}
		$this->ajaxReturn($this->response);
	}
	//精彩活动列表
	public function actives($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
		//返回请求参数
		$this->response->head->res_arg="";
	
		$a_model=D('Active');
		$actives=$a_model->field('`id`,`act_name`,`url`,`act_img`,`act_atime`')->where(array('status'=>1))->order('act_atime desc')->select();
		if(!empty($actives)){
			foreach ($actives as $k=>$v){
				$actives[$k]['act_img']=empty($v['act_img'])?'':SITE_URL.$v['act_img'];
				$actives[$k]['url']=empty($v['url'])?SYSTEM_URL.'public/activeinfo/id/'.$v['id']:$v['url'];
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$actives;
		}
		$this->ajaxReturn($this->response);
	}
	//加入官微、关于我们、版权信息、注册协议    详情页
	public function webinfo($field){
		$request=json_decode($field);
		//返回请求参数
		$this->response->head->res_arg="";
		$flag=$request->flag;
		$arr=array();
		//生成网址就行
		$arr['url']=SYSTEM_URL.'public/info/flag/'.$flag;
	
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$arr;
	
		$this->ajaxReturn($this->response);
	}
	//听友评论
	public function commentlist($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="commentlist";
		$this->response->body->field="[]";
		//景区id
		$id=$request->id;
		$id=intval($id);
		$sc_model=D('Admin://SceComment');
	
		$sce_comments=$sc_model->field('uid,sce_id,images,content,time')->where(array('sce_id'=>$id))->relation(true)->order('time desc')->select();
		if(!empty($sce_comments)){
			foreach ($sce_comments as $k=>$v){
				//评论内容为图片
				if(!empty($v['images'])){
					$imgs=D('SceImg')->query("SELECT CONCAT('".SITE_URL."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".trim($v['images'],',').")");
					$sce_comments[$k]['images']=$imgs;
				}
// 				else
// 				{
// 					$sce_comments[$k]['images']=array();
// 				}
				//景区主图
				$sce_comments[$k]['sce_img']=empty($v['sce_img'])?'':SITE_URL.$v['sce_img'];
				//用户头像
				$sce_comments[$k]['avatar']=empty($v['avatar'])?dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg':dirname(SITE_URL).'/avatar/'.$v['avatar'];
				//评论内容
				$sce_comments[$k]['content']=empty($v['content'])?'':$v['content'];
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$sce_comments;
		}
		$this->ajaxReturn($this->response);
	}
//最近景区
	public function nearscenic($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		//lng 经度  lat 纬度
		$lng1=$request->lng;
		$lat1=$request->lat;
	
		//查找景区     与此刻所在地距离小于五千米
		//赤道上经度1°对应在地面上的弧长大约也是111km为最大   附近的景区
		$long=100/111;
		$map['status']=1;
		$map['_string']='(sce_longitude<='.($lng1+$long).' and sce_longitude>='.($lng1-$long).') or (sce_latitude<='.($lat1+$long).' and sce_latitude>='.($lat1-$long).')';
		$scenics=D('Scenic')->field('id,sce_img,sce_name,sce_count,sce_grade,sce_detail,sce_latitude,sce_longitude')->where($map)->select();
		if(!empty($scenics)){
			$dis=array();
			$scenic=array();
			foreach ($scenics as $k=>$v){
	
				//计算两点之间的距离   以千米为单位
				$distance=$this->getdistance($lng1, $lat1, $v['sce_longitude'], $v['sce_latitude']);
				//两点之间控制在五千米范围内
				if($distance<=100){
					$scenics[$k]['sce_img']=empty($v['sce_img'])?'':SITE_URL.$v['sce_img'];
					$dis[$k]=$distance;
					$scenics[$k]['distance']=$distance;
					unset($scenics[$k]['sce_longitude']);
					unset($scenics[$k]['sce_latitude']);
					$scenics[$k]['sce_detail']=empty($v['sce_detail'])?'':msubstr($v['sce_detail'], $start=0, 20, $charset="utf-8", $suffix=true);
				}else{
					unset($scenics[$k]);
				}
			}
			if(!empty($dis)){
				if(asort($dis)){
					foreach ($dis as $dk=> $dv){
						array_push($scenics[$dk], $dv);
						$scenic[]=$scenics[$dk];
					}
				};
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$scenic;
		}
		$this->ajaxReturn($this->response);
	}
	
	//计算两点经纬度之间的距离   单位为公里
	function getdistance($lng1,$lat1,$lng2,$lat2)//根据经纬度计算距离
	{
		//将角度转为狐度
		$radLat1=deg2rad($lat1);
		$radLat2=deg2rad($lat2);
		$radLng1=deg2rad($lng1);
		$radLng2=deg2rad($lng2);
		$a=$radLat1-$radLat2;//两纬度之差,纬度<90
		$b=$radLng1-$radLng2;//两经度之差纬度<180
		$s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137;
		return $s;
	}
	//用户注册接口
	public function register($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		$email=$request->email;
		$username=$request->username;
		$pwd=$request->passwd;
		if(empty($username)||empty($pwd)||empty($email)){
			$this->response->body->field="用户信息不完善";
			return $this->ajaxReturn($this->response);
			exit;
		}
		//验证用户名或者邮箱是否存在
		$where['username']=$username;
		$where['email']=$email;
		$where['_logic'] = 'or';
		$member=D('member')->where($where)->find();
		
		//用户名已经存在
		if(count($member)>0){
			$this->response->body->field="用户名已存在";
		}else{
			//注册用户
			$data['username']=$username;
			$data['pwd']=md5($pwd);
			$data['email']=$email;
			$data['reg_date']=time();
			$res=D('member')->add($data);
			//注册成功
			if($res){
				//openfire中插入数据
				$map['username']=$username;
				$map['plainPassword']=$pwd;
// 				$map['encryptedPassword']=md5($pwd);
				$map['creationDate']=time();
				$map['modificationDate']=time();
				$ofuser=D('Ofuser')->add($map);
				//插入成功
				if($ofuser){
					$user['uid']=$res;
					$user['username']=$username;
					$user['avatar']=dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg';
					$user['sex']='女';
					$user['nickname']=empty($user['nickname'])?"无":$user['nickname'];
					$user['address']='无';
					$user['sign']='无';
					$user['mobile']='无';
					$this->response->head->res_code="0000";
					$this->response->head->res_msg="success";
					$this->response->body->field=$user;
				}
			}
		}
		return $this->ajaxReturn($this->response);
	}
	
	//用户登录接口
	public function login($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$username=$request->username;
		$pwd=$request->password;
		
		if(empty($username)||empty($pwd)){
			$this->response->field="用户名或密码不能为空";
			return $this->ajaxReturn($this->response);
			exit;
		}
		$user=M('member')->field('id,username,email,avtar,truename,city,lxdz,sex,avtar,birthday')->where(array('username'=>$username,'pwd'=>md5($pwd)))->find();
		//登录
		if(!empty($user))
		{
				$user['userid']=$user['id'];
				$user['userNick']=empty($user['truename'])? $user['username']:$username['truename'];
				$user['city']=empty($user['city'])?"无":$user['city'];
				$user['contact']=empty($user['lxdz'])?"无":$user['lxdz'];
				$user['sex']=(empty($user['sex'])||($user['sex']==0))?'女':'男';
				$user['headImg']=empty($user['avtar'])?dirname(SITE_URL).'/Public/User/img/avtar_big.jpg':dirname(SITE_URL).'/'.$user['avtar'];
				if(!empty($user['birthday'])){
					$yeararr=explode('-', $user['birthday']);
					$user['age']=date("Y")-$yeararr[0];
				}
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$user;
			
		}
		return $this->ajaxReturn($this->response);
	}
	//用户资料编辑接口
	public function edituser($field){
		$request=json_decode($field,true);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$uid=$request['uid'];
		//用户存在
		if(D('member')->field('uid')->find($uid)){
			$map['uid']=$uid;
			$filename='';
			foreach ($request as $k=>$v){
				if($k!='uid'){
					$map[$k]=$v;
					$map['upd_date']=time();
					//更新用户头像
					if($k=='avatar'){
						$data = base64_decode($v);
// 						$v=str_replace('\n','', $v);
						$im = imagecreatefromstring($data);
						if ($im !== false) 
						{
							header('Content-Type: image/png');
							$filename=time().rand(1, 100).".png";
							imagepng($im,dirname(UPLOAD_PATH).'/avatar/'.$filename);
							//保存头像名
							$map['avatar']=$filename;
							imagedestroy($im);
						}
						else
						{
							$this->response->body->field="上传图片格式错误";
							return $this->ajaxReturn($this->response);
						}
					}
					if($k=='sex')$map['sex']=($v=='男')?1:0;
					$res=D('member')->save($map); 
					$map['avatar']=empty($map['avatar'])?dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg':dirname(SITE_URL).'/avatar/'.$filename;
					
					unset($map['upd_date']);
					//更新成功
					if($res){
						$this->response->head->res_code="0000";
						$this->response->head->res_msg="success";
						$this->response->body->field=$map;
					}
				}
			}
		}else{
			$this->response->body->field="用户不存在或者已经被删除";
		}
		return $this->ajaxReturn($this->response);
	}
	//发表说说接口  （文字和图片）
	public function say($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		$uid=$request->uid;
		$content=$request->content;
		$imgarr=$request->photo;
	
		if(empty($content)&&empty($imgarr))
		{
			$this->response->head->res_msg="没有发表任何内容";
			$this->ajaxReturn($this->response);
			exit;
		}
		//发表图片说说
		if(!empty($imgarr))
		{
			$photo="";
			$hi_model=D('SceImg');
			foreach ($imgarr as $key => $val)
			{
				$img = base64_decode($val);
				$im = imagecreatefromstring($img);
				if ($im !== false) {
					header('Content-Type: image/png');
					$filename=time().rand(1, 100).".png";
					imagepng($im,dirname(UPLOAD_PATH).'/say/'.$filename);
					$arr['imgurl']=$filename;
					imagedestroy($im);
					$res=$hi_model->add($arr);
					$photo=$photo.$res.",";
				}
				else
				{
					$this->response->body->field="上传图片格式错误";
					$this->ajaxReturn($this->response);
				}
			}
			$data['images']=trim($photo,',');
		}
		$data['uid']=$uid;
		$data['time']=time();
		$data['content']=$content;
		$hc_model=D('Say');
		if($hc_model->add($data)){
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="发布成功";
		}else{
			$this->response->head->res_code="0001";
			$this->response->head->res_msg="发布失败";
		}
		$this->ajaxReturn($this->response);
	}
	//朋友圈
	public function friendscircle($field){
	
		$request=json_decode($field);
		$uid=$request->uid;
		$dire=$request->dire;
		$time=$request->time;
		$pagesize=10;
	
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
	
		$m_model=D("Member");
		$member=$m_model->find($uid);
		if(empty($member))
		{
			$this->response->head->res_code="0001";
			$this->response->head->res_msg="该用户不存在";
			$this->response->body->field="";
		}
		else
		{
			//用户好友列表
			$f_model=D("Friends");
			$f=$f_model->query("select GROUP_CONCAT(friendid) fids from __TABLE__ where uid=".$member['uid']);
			$order="";
			if(empty($time))
			{
				$order="time desc";
			}
			else
			{
				if($dire=="up")
				{
					$where['time']=array('lt',$time);
					$order="time desc";
				}
				else
				{
					$where['time']=array('gt',$time);
					$order="time asc";
				}
			}
			//存在好友的情况   查找好友的id
			if(!empty($f[0]['fids']))
			{
				$friends=$m_model->query("select GROUP_CONCAT(uid) uids from __TABLE__ where  uid in(".$f[0]['fids'].")");
			}
			//朋友圈
			if(!empty($friends[0]['uids'])){
				$where['_string'] = ' (uid in ('.$friends[0]["uids"].'))  OR ( uid='.$uid.') ';
			}else{
				//用户自己的
				$where['uid']=$uid;
			}
			//查看好友说说
			$s_model=D('Say');
			$says=$s_model->field('id,uid,content,images,time')->where($where)->relation(true)->order($order)->limit($pagesize)->select();
			//学友圈动态
			if(!empty($says))
			{
				foreach($says as $k=>$v)
				{
					$says[$k]['content']=empty($v['content'])?'':$v['content'];
					if(!empty($v['images'])){
						//图片说说
						$img=D('SceImg')->query("SELECT CONCAT('".dirname(SITE_URL).'/say/'."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".$v['images'].")");
						$says[$k]['images']=$img;
					}
					$says[$k]['avatar']=empty($v['avatar'])?dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg':dirname(SITE_URL).'/avatar/'.$v['avatar'];
					$says[$k]['nickname']=empty($v['nickname'])?"无":$v['nickname'];
					
				}
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$says;
			}
			else
			{
				$this->response->head->res_code="0001";
				$this->response->head->res_msg="error";
			}
		}
		$this->ajaxReturn($this->response);
	}
	//添加好友
	public function addfriend($field) {
		$request = json_decode ( $field );
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
		//用户id
		$uid= $request->uid;
		//好友id
		$friendid = $request->friendid;
	
		if(empty($uid)||empty($friendid))
		{
			$this->response->head->res_code = "0001";
			$this->response->head->res_msg = "用户或好友不能为空";
			$this->ajaxReturn ( $this->response );
			exit;
		}
	
		//查找好友
		$m_model = D ( "Member" );
		$member=$m_model->field('uid')->find($friendid);
		if(empty($member))
		{
			$this->response->head->res_code = "0001";
			$this->response->head->res_msg = "用户不存在";
			$this->ajaxReturn ( $this->response );
			exit;
		}
	
		if($uid==$friendid)
		{
			$this->response->head->res_code = "0001";
			$this->response->head->res_msg = "不能添加自己为好友";
			$this->ajaxReturn ( $this->response );
			exit;
		}
	
		//查询登录用户
		$user = $m_model->field('uid')->find ($uid);
		if (empty ( $user ))
		{
			$this->response->head->res_code = "0001";
			$this->response->head->res_msg = "用户不存在";
		}
		else
		{
			$f_model=D("Friends");
			//好友列表中已经存在好友
			if($f_model->where(array('uid'=>$uid,'friendid'=>$friendid))->find())
			{
				$this->response->head->res_code = "0002";
				$this->response->head->res_msg = "该用户已是你的好友";
				$this->ajaxReturn ( $this->response );
				exit;
			}
			if($f_model->add(array('uid'=>$uid,'friendid'=>$friendid)))
			{
				$this->response->head->res_code = "0000";
				$this->response->head->res_msg = "success";
			}
			else
			{
				$this->response->head->res_code = "0001";
				$this->response->head->res_msg = "error";
			}
		}
		$this->ajaxReturn($this->response);
	}
//通讯录
	public function address($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
		//返回请求参数
		$this->response->head->res_arg="";
		
		$uid=$request->uid;
		$m_model=D("Member");
		$member=$m_model->find($uid);
		if(!empty($member))
		{
			$map=array();
			$f_model=D("Friends");
			//查询好友列表
			$f=$f_model->query("select GROUP_CONCAT(friendid) fids from __TABLE__ where uid=".$member['uid']);
			if(!empty($f[0]['fids'])){
				$where['_string'] = ' (uid in ('.$f[0]["fids"].'))  OR ( uid='.$uid.') ';
			}else{
				$where['uid']=$uid;
			}
			$friends=$m_model->field('uid,username,nickname,avatar,address,sign,mobile')->where($where)->select();
			if(empty($friends)){
				$this->response->head->res_code="0001";
				$this->response->head->res_msg="";
			}else{
				foreach($friends as $k=>$v)
				{
					$friends[$k]['avatar']=empty($v['avatar'])?dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg':dirname(SITE_URL).'/avatar/'.$v['avatar'];
					$friends[$k]['nickname']=empty($v['nickname'])?'无':$v['nickname'];
					$friends[$k]['address']=empty($v['address'])?'无':$v['address'];
					$friends[$k]['sign']=empty($v['sign'])?'无':$v['sign'];
					$friends[$k]['mobile']=empty($v['mobile'])?'无':$v['mobile'];
					$friends[$k]['images']='';
					//查找最近上传图片说说
					$says=D('Say')->field('images')->where(array('uid'=>$v['uid'],'images'=>array('neq','')))->order('time desc')->limit(3)->select();
					$ids="";
					if(!empty($says)){
						foreach ($says as $key=>$val){
							$ids.=$val['images'].',';
						}
						$friends[$k]['images']=D('SceImg')->query("SELECT CONCAT('".dirname(SITE_URL).'/say/'."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".trim($ids,',').")");
					}
				}
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$friends;
			}
		}
		$this->ajaxReturn($this->response);
	}
	//个人主页
	public function homepage($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="fail";
		$this->response->body->field="[]";
		$this->response->head->res_arg='';
	
		$uid=$request->uid;
		$dire=$request->dire;
		$time=$request->time;
		$pagesize=10;
		//查询用户说说表
		$s_model=D('Say');
	
		$where['uid']=$uid;
		if(empty($time))
		{
			$order="time desc";
		}
		else
		{
			if($dire=="up")
			{
				$where['time']=array('lt',$time);
				$order="time desc";
			}
			else
			{
				$where['time']=array('gt',$time);
				$order="time asc";
			}
		}
		$says=$s_model->field('uid,images,time,content')->where($where)->limit($pagesize)->order($order)->select();
		//发表的说说内容为空
		if(!empty($says))
		{
			foreach ($says as $key => $val ){
				$says[$key]['time']=date('m月d日',$val['time']);
				$says[$key]['content']=empty($val['content'])?"":$val['content'];
				if(!empty($val['images'])){
					//查询图片表
					$arr['id']=array('in',$val['images']);
					$img=D('SceImg')->query("SELECT CONCAT('".dirname(SITE_URL).'/say/'."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".$val['images'].")");
					$says[$key]['images']=$img;
				}
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="成功";
			$this->response->body->field=$says;
		}
		$this->ajaxReturn($this->response);
	}
	//我的足迹
	public function myfootprint($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="fail";
		$this->response->body->field="[]";
		$this->response->head->res_arg='';
	
		$uid=$request->uid;
		$logs=D('Log')->field('uid,sce_id')->where(array('uid'=>$uid))->relation(true)->select();
		if(!empty($logs)){
			foreach ($logs as $k=>$v){
				$logs[$k]['sce_detail']=empty($v['sce_detail'])?'':msubstr($v['sce_detail'], $start=0, 20, $charset="utf-8", $suffix=true);
				$logs[$k]['sce_img']=empty($v['sce_img'])?'':SITE_URL.$v['sce_img'];
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="成功";
			$this->response->body->field=$logs;
		}
		$this->ajaxReturn($this->response);
	}
	//查找好友      根据好友的账号或昵称
	public function findfriend($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="fail";
		$this->response->body->field="[]";
		//关键字
		$key=$request->type;
		$uid=$request->uid;
		$this->response->head->res_arg=$key;
		
		if(empty($key)){
			$this->ajaxReturn($this->response);
			exit;
		}
		
// 		$map['_string']="(username like '%".$key."%' OR nickname like '%".$key."%') AND (uid <> ".$uid.")";
		$map['_string']="(username='".$key."' OR nickname='".$key."') AND (uid <> ".$uid.")";
		//查找好友
// 		$friends=D('Member')->field('uid,username,avatar,nickname,address,sign,mobile')->where($map)->select();
		$friend=D('Member')->field('uid,username,avatar,nickname,address,sign,mobile')->where($map)->find();
		if(!empty($friend)){
// 			foreach ($friends as $k => $v){
				//查看是否已经是好友
				if(D('Friends')->where(array('uid'=>$uid,'friendid'=>$friend['uid']))->find())
				{
					$this->response->head->res_code="0001";
					$this->response->head->res_msg="error";
					$this->response->body->field="该用户已经是您好友";
				}
				else 
				{
					$friend['avatar']=empty($friend['avatar'])?dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg':dirname(SITE_URL).'/avatar/'.$friend['avatar'];
					$friend['nickname']=empty($friend['nickname'])?'无':$friend['nickname'];
					$friend['address']=empty($friend['address'])?'无':$friend['address'];
					$friend['sign']=empty($friend['sign'])?'无':$friend['sign'];
					$friend['mobile']=empty($friend['mobile'])?'无':$friend['mobile'];
					$friend['images']='';
					//查找最近上传图片说说
					$says=D('Say')->field('images')->where(array('uid'=>$friend['uid'],'images'=>array('neq','')))->order('time desc')->limit(3)->select();
					$ids="";
					if(!empty($says)){
						foreach ($says as $key=>$val){
							$ids.=$val['images'].',';
						}
						$friend['images']=D('SceImg')->query("SELECT CONCAT('".dirname(SITE_URL).'/say/'."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".trim($ids,',').")");
					}
					$this->response->head->res_code="0000";
					$this->response->head->res_msg="success";
					$this->response->body->field=$friend;
				}
// 			}
		}
		else{
			$this->response->body->field="暂没有符合条件的好友";
		}
		$this->ajaxReturn($this->response);
	}
	//附近的人
	public function nearbypeople($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		//lng 经度  lat 纬度
		$lng1=$request->lng;
		$lat1=$request->lat;
		$uid=$request->uid;
		
		//点击附近的人，保存此时用户所在地的经纬度
		$data['uid']=$uid;
		$data['longitude']=$lng1;
		$data['latitude']=$lat1;
		//保存成功
		D('Member')->save($data);
		//保存
		//附近的人     与此刻所在地距离小于0.1千米
		//赤道上经度1°对应在地面上的弧长大约也是111km为最大   附近的人
		$long=5/111;
		$map['status']=1;
		$map['uid']=array('neq',$uid);
		$map['_string']='(longitude<='.($lng1+$long).' and longitude>='.($lng1-$long).') or (latitude<='.($lat1+$long).' and latitude>='.($lat1-$long).')';
		$members=D('Member')->field('uid,address,username,sign,mobile,nickname,avatar,longitude,latitude')->where($map)->select();
		if(!empty($members)){
			$dis=array();
			$friends=array();
			foreach ($members as $k=>$v){
					
				//计算两点之间的距离   以千米为单位
				$distance=$this->getdistance($lng1, $lat1, $v['longitude'], $v['latitude']);
				//两点之间控制在0.1千米范围内
				if($distance<=5){
					$members[$k]['avatar']=empty($v['avatar'])?dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg':dirname(SITE_URL).'/avatar/'.$v['avatar'];
					$dis[$k]=$distance;
					$members[$k]['distance']=$distance;
					$members[$k]['nickname']=empty($v['nickname'])?'无':$v['nickname'];
					$members[$k]['address']=empty($v['address'])?'无':$v['address'];
					$members[$k]['sign']=empty($v['sign'])?'无':$v['sign'];
					$members[$k]['mobile']=empty($v['mobile'])?'无':$v['mobile'];
					$members[$k]['images']='';
		
					//查找最近上传图片说说
					$says=D('Say')->field('images')->where(array('uid'=>$v['uid'],'images'=>array('neq','')))->order('time desc')->limit(3)->select();
					$ids="";
					if(!empty($says)){
						foreach ($says as $key=>$val){
							$ids.=$val['images'].',';
						}
						$members[$k]['images']=D('SceImg')->query("SELECT CONCAT('".dirname(SITE_URL).'/say/'."',`imgurl`) imgurl FROM __TABLE__ WHERE `id` IN (".trim($ids,',').")");
					}
					unset($members[$k]['longitude']);
					unset($members[$k]['latitude']);
				}else{
					unset($members[$k]);
				}
			}
			if(!empty($dis)){
				if(asort($dis)){
					$friends=array();
					foreach ($dis as $dk=> $dv){
						array_push($members[$dk], $dv);
						$friends[]=$members[$dk];
					}
				}
			}
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$friends;
		}
		$this->ajaxReturn($this->response);
	} 
	//重设密码
	public function resetpass($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		$username=$request->username;
		$oldpass=$request->oldpass;
		$newpass=$request->newpass;
	
		//查看用户是否存在
		$u_model=D('Member');
		$user=$u_model->field('uid,username,pwd')->where(array('username'=>$username,'pwd'=>md5($oldpass)))->find();
		//用户存在
		if(!empty($user))
		{
			//更改新密码
			$res=$u_model->save(array('uid'=>$user['uid'],'pwd'=>md5($newpass)));
			if($res)
			{
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field="密码修改成功";
			}
			else
			{
				$this->response->body->field="密码修改失败";
			}
		}
		//用户不存在
		else
		{
			$this->response->body->field="用户不存在";
		}
		$this->ajaxReturn($this->response);
	}
	//检测用户名和邮箱是否匹配
	public function checkemail($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		$username=$request->username;
		$email=$request->email;
		//查找邮箱和用户是否匹配
		$u_model=D('Member');
		$user=$u_model->field('uid,email,username')->where(array('username'=>$username,'email'=>$email))->find();
		//邮箱匹配
		if($user)
		{
			//找回密码随机码
			$code=md5(time().rand(1000));
			//发送邮件
			$return = send_mail($user['email'], "","边走边听用户找回密码","边走边听找回密码点击以下链接<br/><a href='".SYSTEM_URL."user/findpass/code/".$code."'>".SYSTEM_URL."user/findpass/code/".$code."</a><br/>该链接30分钟有效，30分钟后自动失效。","",'');
			//邮件发送成功
			if($return==1)
			{
				$res=D('Member')->save(array('uid'=>$user['uid'],'find_fwd_code'=>$code,'find_pwd_time'=>time(),'find_pwd_exp_time'=>time()+30*60));
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field="邮件已经发送至注册邮箱，请登录邮箱修改密码";
			}
			else
			{
				$this->response->body->field="邮件发送失败";
			}
		}
		//不匹配
		else
		{
			$this->response->body->field="用户名邮箱不匹配";
		}
		$this->ajaxReturn($this->response);
	}
	//随机生成用户名
	public function randstr($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$randstr=$this->checkusername();
		
		//注册用户
		$data['username']=$randstr;
		$data['pwd']=md5('888888');
// 		$data['email']=$email;
		$data['reg_date']=time();
		$res=D('member')->add($data);
		//注册成功
		if($res)
		{
			//openfire中插入数据
			$map['username']=$randstr;
			$map['plainPassword']='888888';
			$map['modificationDate']=time();
			$map['creationDate']=time();
			$map['modificationDate']=time();
			$ofuser=D('Ofuser')->add($map);
			//插入成功
			if($ofuser)
			{
				$user['uid']=$res;
				$user['username']=$randstr;
				$user['avatar']=dirname(SITE_URL).'/avatar/20131223/20131223165003_55766.jpg';
				$user['sex']='女';
				$user['nickname']=empty($user['nickname'])?"无":$user['nickname'];
				$user['address']='无';
				$user['sign']='无';
				$user['mobile']='无';
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$user;
			}
		}
		$this->ajaxReturn($this->response);
	}
	//检测随机生成的用户名是否已经存在
	private function checkusername(){
		//随机生成5~15位的用户名
		$len=rand(5,15);
		$randstr=randCode($len,5);
		//检查用户名是否已经存在
		$count=D('Member')->where(array('username'=>$randstr))->count();
		if($count>0)
		{
			$randstr=$this->checkusername();
		}
		return $randstr;
	}
	//搜索周边
	//http://api.map.baidu.com/place/v2/search?&query=酒店&location=39.915,116.404&radius=2000&output=xml&ak=z42QRjs4rGXWQiYIAw6ELT18&scope=2
	public function searcharound($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->body->field="[]";
		$data['type']=trim($request->type);
		$this->response->head->res_arg=$request->type;
		//根据景区id查找经纬度
		//景区id
		$id=$request->id;
		$s_model=D('Scenic');
		
		$scenics=$s_model->field('sce_longitude,sce_latitude')->find(intval($id));
		$key=md5('searcharound'.$id.$data['type']);
		if(empty($scenics))
		{
			$this->response->body->field="景区不存在，或者景区已被删除";
			$this->ajaxReturn($this->response);
		}
		
	 	$mem=new Memcache();
        if(!$mem->connect("202.106.63.227",'11211'))
        {
           $this->response->body->field="服务器出错，请重试";
		   $this->ajaxReturn($this->response);
        }
		$arrs=$mem->get($key);
		// 获取缓存数据
		if(!empty($arrs))
		{
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$arrs;
			$this->ajaxReturn($this->response);
		}
		//纬度
		$data['lat']=$scenics['sce_latitude'];
		//经度
		$data['lng']=$scenics['sce_longitude'];
		$result=$this->getContent($data);
		//status==0 返回成功
		if($result['status']==0)
		{
			if(!empty($result['results']))
			{
				$arr=array();
				foreach ($result['results'] as $k=>$v){
					$arr[$k]['nickname']=$v['name'];
					$arr[$k]['sce_latitude']=$v['location']['lat'];
					$arr[$k]['sce_longitude']=$v['location']['lng'];
					$arr[$k]['content']=$v['address'];
					$arr[$k]['distance']=$v['detail_info']['distance'];
				}
				$mem->set($key,$arr,0,7*24*3600);  // 缓存name数据
				
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$arr;
			}
			else
			{
				$this->response->body->field="没有符合条件的相关搜索";
			}
		}
		else
		{
			$this->response->body->field="搜索失败，请重试";
		}
		$this->ajaxReturn($this->response);
	}
	//最近景点
	public function nearview($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
	
		//lng 经度  lat 纬度
		$lng1=$request->lng;
		$lat1=$request->lat;
		//景区id
		$sce_id=$request->id;
	
		//查找景点     与此刻所在地距离小于20米
		//赤道上经度1°对应在地面上的弧长大约也是111km为最大   附近的景区
		//$long=0.02/111*10;
		$long=5/11100;

		$map['status']=1;
		$map['sce_id']=$sce_id;
		$map['_string']='(view_longitude<='.($lng1+$long).' and view_longitude>='.($lng1-$long).') or (view_latitude<='.($lat1+$long).' and view_latitude>='.($lat1-$long).')';
		$model=D('View');
		$views=$model->field('id,view_name,view_voice,view_longitude,view_latitude')->where($map)->select();
		$this->response->head->res_msg=$model->getLastSql();
		
		if(!empty($views)){
				
// 			$mem=new Memcache();
// 			//当编辑景区的时候要清除缓存
// 			if(!$mem->connect("202.106.63.227",'11211'))
// 			{
// 				$this->response->body->field="服务器出错，请重试";
// 				$this->ajaxReturn($this->response);
// 			}
			$dis=array();
			$view=array();
			foreach ($views as $k=>$v){
	
				//计算两点之间的距离   以千米为单位
				$distance=$this->getdistance($lng1, $lat1, $v['view_longitude'], $v['view_latitude']);
				//两点之间控制在五千米范围内
				if($distance<=10000){
					$dis[]=$distance;
					$dis1[]=intval($distance*1000);
					$views[$k]['distance']=$distance;
 					$views[$k]['view_voice']=empty($v['view_voice'])?'':"http://www.bianzoubianting.com/Uploads/scenic/".$v['view_voice'];
					unset($views[$k]['view_longitude']);
					unset($views[$k]['view_latitude']);
				}else{
					unset($views[$k]);
				}
			}
			if(!empty($dis)){
				//判断所有的景点经纬度是否一样
	
				if(asort($dis)){
					asort($dis1);
					$arr=array_count_values($dis1);
					//相同的值
					$i=0;
					if($arr[$dis1[0]]>1){
						//随机播放一个
						$i=rand(0,$arr[$dis1[0]]-1);
						array_push($views[$i], $dis[$i]);
					}
					else
					{
						array_push($views[$i], $dis[$i]);
					}
						
						
					$key=md5('id');
					//$id=$mem->get($key);
					if($id!=$views[$i]['id']){
						$view[]=$views[$i];
					//	$mem->set($key,$view[0]['id'],0,30);
						$this->response->head->res_code="0000";
					}
					// 					foreach ($dis as $dk=> $dv){
					// 						array_push($views[$dk], $dv);
					// 						$view[]=$views[$dk];
					// 					}
				}
			}
			$this->response->head->res_msg="success";
			$this->response->body->field=$view;
		}
		$this->ajaxReturn($this->response);
	}
	//发送http请求
	private function getContent($data){
		// 初始化一个 cURL 对象
		$curl = curl_init();
	
		// 设置你需要抓取的URL
		curl_setopt($curl, CURLOPT_URL, "http://api.map.baidu.com/place/v2/search?&query=".$data['type']."&location=".$data['lat'].",".$data['lng']."&radius=5000&output=json&ak=z42QRjs4rGXWQiYIAw6ELT18&scope=2&page_size=20&filter=sort_name:distance|sort_rule:1");
	
		// 设置header
		//curl_setopt($curl, CURLOPT_HEADER, 1);
	
		// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
		// 运行cURL，请求网页
		$res = curl_exec($curl);
	
		// 关闭URL请求
		curl_close($curl);
		$res=json_decode($res,true);
		return $res;
	}
}