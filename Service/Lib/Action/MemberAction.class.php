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
	
	
	//用户注册接口
	public function register($field){
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$email=$request->email;
		$username=$request->username;
		$pwd=$request->password;
		$city=$request->city;
		
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
			$this->response->body->field="用户名或者邮箱 已存在";
		}else{
			//注册用户
			$data['username']=$username;
			$data['password']=xmd5($pwd);
			$data['email']=$email;
			$data['city']=$city;
			$data['regtime']=time();
			$memMod=D('member');
			$res=$memMod->add($data);
			$id=$memMod->getLastInsID();
			//注册成功
			if($res){
					$user['id']=$id;
					$user['username']=$username;
					$user['avtar']==empty($user['avtar'])?SITE_URL.'/Public/User/img/avtar_big.jpg':SITE_URL.'/'.$user['avtar'];
					$user['sex']='女';
					$user['nickname']=empty($user['nickname'])?"无":$user['nickname'];
					$user['address']='无';
					$user['sign']='无';
					$user['mobile']='无';
					$user['email']=$email;
					$this->response->head->res_code="0000";
					$this->response->head->res_msg="success";
					$this->response->body->field=$user;
				
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
			$this->response->body->field="用户名或密码不能为空";
			return $this->ajaxReturn($this->response);
			exit;
		}
		
		$memMod=M('member');
		$user=$memMod->field('id,username,email,avtar,truename,city,lxdz,sex,avtar,birthday')->where(array('username'=>$username,'password'=>xmd5($pwd)))->find();
		
		//登录
		if(!empty($user))
		{
				$user['userid']=$user['id'];
				$user['userNick']=empty($user['truename'])? $user['username']:$username['truename'];
				$user['city']=empty($user['city'])?"无":$user['city'];
				$user['contact']=empty($user['lxdz'])?"无":$user['lxdz'];
				$user['sex']=(empty($user['sex'])||($user['sex']==0))?'女':'男';
				
				$user['headImg']=empty($user['avtar'])?SITE_URL.'/Public/User/img/avtar_big.jpg':SITE_URL.'/'.$user['avtar'];
				
				if(!empty($user['birthday'])){
					$yeararr=explode('-', $user['birthday']);
					$user['age']=date("Y")-$yeararr[0];
				}
				$this->response->head->res_code="0000";
				$this->response->head->res_msg="success";
				$this->response->body->field=$user;
			
		}else{
			$cou=$memMod->where(array("username"=>$username))->count();
			if($cou>0){
				$this->response->body->field="密码不正确!";
			}
			else{
				$this->response->body->field="用户名不正确!";
			}
		}
		return $this->ajaxReturn($this->response,"JSON");
	}
	
	//忘记密码
	public function forget($field){
		$cfg_webname="留学网";
		#$cfg_webname=C("SOFT_NAME");
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="";
		$email=$request->email;
		if(empty($email)){
			$this->response->body->field="邮箱不能为空!";
			return $this->ajaxReturn($this->response);
			exit;
		}
		$memMod=M('member');
		$count_user=$memMod->where(array("email"=>$email))->count();
		if($count_user>0){
			//用户存在 修改密码
			$pwd=rand(100000, 999999);
			$pwd2=xmd5($pwd);
			$memMod->where(array('email'=>$email))->save(array('password'=>$pwd2));
			$meminfo=$memMod->where(array('email'=>$email))->find();
			$pubdate=date("Y-m-d H:i:s");
			//发送邮件
			
			$content =<<<DATA
				<div style="padding: 30px">
				<div>
				<p>亲爱的：<b>{$meminfo['username']}</b> ：</p>
				</div>
				<div style="margin: 6px 0 60px 0;">
				<p>您的新密码是:<strong>{$pwd}</strong></p>
				</div>
				<div style="color: #999;">
				<p>发件时间：{$pubdate}</p>
				<p>此邮件为系统自动发出的，请勿直接回复。</p>
				</div>
				</div>
DATA;

			import('ORG.Mail');
			SendMail($email,$cfg_webname.":找回密码邮件",$content,$cfg_webname);
			
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field="操作成功,请去您的邮箱查看您的新密码!";
		}
		else{
			//用户不存在
			$this->response->body->field="没有找到邮箱！";
			
		}
		return $this->ajaxReturn($this->response,"JSON");
		exit;
		
	} 
	
	//生活
	public function life($field){
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$lMod=M("Life");
		$life_list=$lMod->select();
		$lf_img=array();
		foreach ($life_list as $k=>$v){
			$lf_img[$k]['id']=$v['l_id'];
			$lf_img[$k]['img_url']=empty($v['l_img_url'])?SITE_URL.'/Public/User/img/avtar_big.jpg':SITE_URL.'/'.$v['l_img_url'];
			$lf_img[$k]['url']=$v['url'];
			
		}
		if(!empty($lf_img)){
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$lf_img;
		}else{
			$this->response->head->res_code="0001";
			$this->response->head->res_msg="error";
			$this->response->body->field="很抱歉没有信息";
		}
		return $this->ajaxReturn($this->response,"JSON");
	}
	//社区接口
	public function fellow($field){
		$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		$request=json_decode($field);
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		$fellowMod=M("Fellow");
		$fellow_list=$fellowMod->order(" addtime desc ")->limit($offset.",".$length)->select();
		foreach ($fellow_list as $k=>$v){
			if(empty($v['img'])){
				$fellow_list[$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			}else{
				$fellow_list[$k]['img']=$v['img'];
			}
			
		}
		if(!empty($fellow_list)){
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$fellow_list;
		}else{
			$this->response->body->field="很抱歉没有信息";
		}
		return $this->ajaxReturn($this->response,"JSON");
	}
	//生活黄页  分类
	public function yellowpagesclasses($field){
		$ypcMod=M("yellowpagesclasses");
		$yplist=$ypcMod->order(" sortid asc ")->select();
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		if(!empty($yplist)){
			$this->response->body->field=$yplist;
		}else{
			$this->response->body->field="很抱歉没有信息";
		}
		return $this->ajaxReturn($this->response,"JSON");
			
	}
	//生活黄页幻灯片接口
	public function yellowpageshpd($field){
	   $ypcMod=M("yellowpages");
		 $yplist=$ypcMod->where(array('is_hdp'=>1))->order(" id desc ")->select();
		 $this->response->head->res_code="0001";
		 $this->response->head->res_msg="error";
		 $this->response->head->res_arg="";
		 $this->response->body->field="[]";
		 
		 if(!empty($yplist)){
			foreach ($yplist as $k=>$v){
				if(empty($v['img'])){
					$yplist[$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
				}else{
					$yplist[$k]['img']=$v['img'];
				}
			}
			
			$this->response->body->field=$yplist;
		}else{
			$this->response->body->field="很抱歉没有信息";
		}
		return $this->ajaxReturn($this->response,"JSON");
	}
	
	
	//生活黄页
	public function yellowpages($field){
		$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		$class_id=$request->class_id;
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$yellowpagesMod=M("yellowpages");
		$yellowpages_list=$yellowpagesMod->where(array("class_id"=>$class_id))->order(" addtime desc ")->limit($offset.",".$length)->select();
		foreach ($yellowpages_list as $k=>$v){
			if(empty($v['img'])){
				$yellowpages_list[$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			}else{
				$yellowpages_list[$k]['img']=$v['img'];
			}
			
		}
		if(!empty($yellowpages_list)){
			$this->response->head->res_code="0000";
			$this->response->head->res_msg="success";
			$this->response->body->field=$yellowpages_list;
		}else{
			$this->response->body->field="很抱歉没有信息";
		}	
		return  $this->ajaxReturn($this->response,"JSON");
	}
	//法律援助
	public function law($field){
		$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$lawMod=M("law");
		
		$law=array();
		$law_list=$lawMod->order(" addtime desc ,sortid desc ")->limit($offset.",".$length)->select();
		foreach ($law_list as $k=>$v){
			if(empty($v['img'])){
				$law['data'][$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			}else{
				$law['data'][$k]['img']=$v['img'];
			}
			$law['data'][$k]['id']=$v['id'];
			$law['data'][$k]['title']=$v['title'];
			$law['data'][$k]['introduction']=$v['introduction'];
			
		}
		$img=$lawMod->where(array("is_hdp"=>1))->order("sortid desc ")->select();
		foreach ($img as $k=>$v){
			
			if(empty($v['img'])){
				$law['img'][$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			}else{
				$law['img'][$k]['img']=$v['img'];
			}
			$law['img'][$k]['id']=$v['id'];
			$law['img'][$k]['title']=$v['title'];
		}
		
		
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$law;
			
		
		return  $this->ajaxReturn($this->response,"JSON");
		
	}
	//房屋信息
	public function house($field){
	
$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		
		$usertype=$request->usertype;
		$housetype=$request->housetype;
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$houseMod=M("house");
		$house_list=$houseMod->where(array("usertype"=>$usertype,"housetype"=>$housetype))->limit($offset.",".$length)->order(" addtime desc ")->select();
	
    $house=array();
		foreach ($house_list as $k=>$v){
			if(empty($v['img']))
			$house['data'][$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			else 
			$house['data'][$k]['img']=$v['img'];
			
			$house['data'][$k]['title']=$v['title'];
			$house['data'][$k]['lat']=$v['lat'];
			$house['data'][$k]['lng']=$v['lng'];
			$house['data'][$k]['introduction']=$v['introduction'];
			$house['data'][$k]['content']=$v['content'];
			$house['data'][$k]['id']=$v['id'];
			
		}
		//幻灯片
		$houseMod=M("house");
		$img_list=$houseMod->where(array("is_hdp"=>1))->order(" addtime desc ")->select();
		$house=array();
		foreach ($img_list as $k=>$v){
			if(empty($v['img']))
			$house['img'][$k]['url']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			else 
			$house['img'][$k]['url']=$v['img'];
			
			$house['img'][$k]['title']=$v['title'];
			$house['img'][$k]['id']=$v['id'];
			
		}
		
		
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$house;
			
		
		return  $this->ajaxReturn($this->response,"JSON");
		
	}
	//团购
	public function customers($field){
		$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$cuMod=M("Customers");
		$cusList=$cuMod->order("addtime desc")->limit($offset.",".$length)->select();
		$customers=array();
		foreach ($cusList as $k=>$v){
			$customers[$k]['id']=$v['id'];
			if(empty($v['img']))
			$customers[$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			else
			$customers[$k]['img']=$v['img'];
			
			$customers[$k]['content']=$v['content'];
			$customers[$k]['addtime']=date("Y-m-d H:i:s",$v['addtime']);
			$customers[$k]['introduction']=$v['introduction'];
			$customers[$k]['title']=$v['title'];
			
		}
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$customers;
		
		return $this->ajaxReturn($this->response,"JSON");
		
	}
	//美食信息
	public function food($field){
		$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$foodMod=M("food");
		
		$food_list=$foodMod->order("addtime desc ")->limit($offset.",".$length)->select();
		$food=array();
		foreach ($food_list as $k=>$v){
			$food[$k]['id']=$v['id'];
			$food[$k]['title']=$v['title'];
			
			$food[$k]['classid']=$v['classid'];
			
			if(empty($v['img']))
			$food[$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			else
			$food[$k]['img']=$v['img'];
			
			$food[$k]['introduction']=$v['introduction'];
			$food[$k]['content']=$v['content'];
			$food[$k]['lat']=$v['lat'];
			$food[$k]['lng']=$v['lng'];
			$food[$k]['addtime']=date("Y-m-d H:i:s",$v['addtime']);
			
		}
		
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$food;
		
		return $this->ajaxReturn($this->response,"JSON");
	}
	//热门资讯
	public function information($field){
		$request=json_decode($field);
		$offset=$request->offset;
		$length=$request->length;
		
		$this->response->head->res_code="0001";
		$this->response->head->res_msg="error";
		$this->response->head->res_arg="";
		$this->response->body->field="[]";
		
		$infoMod=M("information");
		$info_list=$infoMod->order("addtime desc")->select();
		$information=array();
		foreach ($info_list as $k=>$v){
			$information[$k]['id']=$v['id'];
			$information[$k]['title']=$v['title'];
			
			if(empty($v['img']))
			$information[$k]['img']=SITE_URL."/Public/Tpl/my/images/42813102.jpg";
			else
			$information[$k]['img']=$v['img'];
			
			$information[$k]['content']=$v['content'];
			
			$information[$k]['introduction']=$v['introduction'];
			$information[$k]['addtime']=date("Y-m-d H:i:s",$v['addtime']);
		}
		$this->response->head->res_code="0000";
		$this->response->head->res_msg="success";
		$this->response->body->field=$information;
		
		return $this->ajaxReturn($this->response,"JSON");
		
	}
	
	
}