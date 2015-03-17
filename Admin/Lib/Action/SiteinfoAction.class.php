<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-1
 * Time: 上午11:54
 */

class SiteinfoAction extends CommonAction {
    /**
     * 菜单显示页面
     */
    public function index(){
        if(IS_POST){
            $act = $_POST['act'];
            $data = $_POST['data'];
            $data['nav_name'] = addslashes($data['nav_name']);
            $M = M("nav");
             if ($act == "edit") { //修改分类
                if (empty($data['nav_name'])) {
                    unset($data['nav_name']);
                }
                if ($data['parent_id'] == $data['id']) {
                    unset($data['parent_id']);
                }
                if($M->save($data)){
                    echo json_encode(array('status' => 1, 'info' => '菜单' . $data['nav_name'] . ' 已经成功更新', 'url' => U('Siteinfo/index', array('time' => time()))));
                }else{
                    echo   json_encode(array('status' => 0, 'info' => '菜单' . $data['nav_name'] . ' 更新失败'));
                }
               // return ($M->save($data)) ? json_encode(array('status' => 1, 'info' => '菜单 ' . $data['nav_name'] . ' 已经成功更新', 'url' => U('Siteinfo/index', array('time' => time())))) : array('status' => 0, 'info' => '菜单 ' . $data['nav_name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset($data['parent_id'], $data['nav_name']);

                 if($M->where('parent_id='.$data['id'].' AND id!='.$data['id'])->count()>0){
                     echo json_encode(array('status' => 0, 'info' => $data['nav_name'] . '存在下级分类，请先删除'));
                     exit;
                 }

                if($M->where($data)->delete()){
                    echo json_encode(array('status' => 1, 'info' => '菜单' . $data['nav_name'] . ' 已经成功删除', 'url' => U('Siteinfo/index', array('time' => time()))));
                }else{
                    echo json_encode(array('status' => 0, 'info' => '菜单' . $data['nav_name'] . ' 删除失败'));
                }
                //return ($M->where($data)->delete()) ? array('status' => 1, 'info' => '菜单 ' . $data['nav_name'] . ' 已经成功删除', 'url' => U('Siteinfo/index', array('time' => time()))) : array('status' => 0, 'info' => '菜单 ' . $data['nav_name'] . ' 删除失败');
            }
        }else{
            import("Category");
            $cat = new Category('Nav', array('id', 'parent_id', 'nav_name', 'fullname'));
            $this->assign("list", $cat->getList());
            $this->display();
        }
    }
    /**
     * 添加菜单
     */
    public function add_nav(){
        C('TOKEN_ON',false);
        if(IS_POST){
            $id=$this->_post('id');
            $data['lang']=$this->_post('lang');
            if(!$data['lang'])unset($data['lang']);
            $data['nav_name']=$this->_post('nav_name');
            $data['parent_id']=$this->_post('parent_id');
            $moduleguide=$this->_post('moduleguide');
            $data['type']=$this->_post('type');
            $data['sort']=$this->_post('sort');
            $data['target']=$this->_post('target');
            $mg=explode('-',$moduleguide);
            $data['module']=$mg[0];
            $data['guide']=$mg[1];
            foreach($data as $v){
                if($v==''){
                    echo json_encode(array('status' => 0, 'info' => '信息未填完整'));
                    return;
                }
            }
            if($data['module']=='link'){
                $data['link']=$this->_post('link');
                if($data['link'])
                if(false===strpos($data['link'],'http://') && false===strpos($data['link'],'https://')){
                    echo json_encode(array('status' => 0, 'info' => '链接地址格式不正确'));
                    return;
                 }
            }
            $m_nav=M('nav');
            if($id){
                $map['id']=$id;
                if($m_nav->where($map)->save($data)){
                    echo json_encode(array('status' => 1, 'info' => '菜单' . $data['nav_name'] . ' 更新成功', 'url' => U('Siteinfo/index', array('time' => time()))));
                }else{
                    echo json_encode(array('status' => 0, 'info' => '菜单' . $data['nav_name'] . ' 更新失败'));
                }
            }else{
                if($m_nav->add($data)){
                    echo json_encode(array('status' => 1, 'info' => '菜单' . $data['nav_name'] . ' 添加成功', 'url' => U('Siteinfo/index', array('time' => time()))));
                }else{
                    echo json_encode(array('status' => 0, 'info' => '菜单' . $data['nav_name'] . ' 添加失败'));
                }
            }

        }else{
            if(intval($_GET['id'])){
                $M=M('nav');
                $map['id']=intval($_GET['id']);
                $info=$M->where($map)->find();
                $this->assign('info',$info);
            }
           // dump($info);
            import("Category");
            $cat = new Category('Nav', array('id', 'parent_id', 'nav_name', 'fullname'));
            $this->assign("list", $cat->getList());

            $map2['type']='p';
            $pro = new Category('Category', array('cid', 'pid', 'name', 'fullname'),$map2);
            $this->assign("prolist", $pro->getList());

            $map2['type']='n';
            $art = new Category('Category', array('cid', 'pid', 'name', 'fullname'),$map2);
            $this->assign("artlist", $art->getList());

            $pagelist = new Category('Page', array('id', 'parent_id', 'page_name', 'fullname'));
            $this->assign("pagelist", $pagelist->getList());

            $this->display();
        }
    }
    /**
     * user：cony
     * 单页列表
     */
     public function page(){
         $M = M("page");
         $count = $M->count();
         import("ORG.Util.Page");       //载入分页类
         $page = new Page($count, 12);
         $showPage = $page->show();
         $list=$M->field('id,unique_id,page_name,display')->order('id desc')->limit("$page->firstRow, $page->listRows")->select();
         $this->assign("page", $showPage);
         $this->assign("list",$list);
         $this->display();
     }
    /**
     * user：cony
     * 修改添加单页
     */
    public function add_page(){
        if(IS_POST){
            $m_page=M('page');
            $data=$_POST['info'];
            $map1['page_name']=$data['page_name'];
            if($data['lang'])$map2['lang']=$data['lang'];
            $map2['unique_id']=$data['unique_id'];
            if($data['id']){
                $map1['id']=$map2['id']=array('neq',$data['id']);
            }
            if(!$data['page_name'] or !$data['unique_id']){
                echo json_encode(array("status" => 0, "info" => "标题和别名不能为空"));
                exit;
            }
            if($m_page->where($map1)->count()>0){
                echo json_encode(array("status" => 0, "info" => "标题已经存在，请修改"));
                exit;
            }
            if($m_page->where($map2)->count()>0){
                echo json_encode(array("status" => 0, "info" => "同一种语言别名已经存在，请修改"));
                exit;
            }
            if($data['id']){
                if($m_page->where('id='.$data['id'])->save($data)){
                    echo json_encode(array("status" => 1, "info" => "修改单页成功",'url'=>U('Siteinfo/page')));
                }
            }else{
                if($m_page->add($data)){
                    echo json_encode(array("status" => 1, "info" => "添加单页成功",'url'=>U('Siteinfo/page')));
                }
            }
        }else{
            $m_page=M('page');
            $map['id']=$this->_get('id');
            $info=$m_page->where($map)->find();

            $pagelist = new Category('Page', array('id', 'parent_id', 'page_name', 'fullname'));
            $this->assign("pagelist", $pagelist->getList());

            $this->assign('info',$info);
            $this->display();
        }

    }
    public function delpage(){
        $id=$this->_get('id');
        if(!$id){
            return false;
        }
        $map['id']=$id;
        $M=M('page');
        if($M->where('parent_id='.$id.' AND id!='.$id)->count()>0){
            echo json_encode(array("status" => 0, "info" =>'删除失败,存在下级单页'));
            exit;
        }
        if($M->where($map)->delete()){
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        }else{
            echo json_encode(array("status" => 0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }
    /**
     * 检查page_name是否重复
     */
    public function checkPageTitle() {
        $M = M("page");
        $where = "page_name='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And id !=" . (int) $_GET['id'];
        }
        if ($M->where($where)->count() > 0) {
            echo json_encode(array("status" => 0, "info" => "已经存在，请修改标题"));
        } else {
            echo json_encode(array("status" => 1, "info" => "可以使用"));
        }
    }
    /**
     * 检查unique_id是否重复
     */
    public function checkPageUnique() {
        $M = M("page");
        $where = "unique_id='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And id !=" . (int) $_GET['id'];
        }
        if ($M->where($where)->count() > 0) {
            echo json_encode(array("status" => 0, "info" => "已经存在，请修改别名"));
        } else {
            echo json_encode(array("status" => 1, "info" => "可以使用"));
        }
    }

    /**
     * 广告图列表
     */
    public function adindex(){
        $M = M("ad");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 10);
        $showPage = $page->show();
        $list=$M->order('id desc')->limit("$page->firstRow, $page->listRows")->order('sort DESC')->select();
        $this->assign("page", $showPage);
        $this->assign("list",$list);
        $this->display();
    }

    /**
     * 添加广告图
     */
    public function add_ad(){
        if(IS_POST){
            $data=$_POST['info'];
            $id=$this->_post('id');
            if($data['ad_name']==''){
                echo json_encode(array("status" => 0, "info" => "广告名称不能为空"));
                exit;
            }
            if($data['ad_link']!="#"){
                if(false===strpos($data['ad_link'],'http://') && false===strpos($data['ad_link'],'https://')){
                    echo json_encode(array("status" => 0, "info" => "链接格式不正确"));
                    exit;
                }
            }
            if($_FILES['ad_img']['name']){
                $dir='./Uploads/pictures/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload($dir)){
                    $data['ad_img']=date('Ym').'/'.$image[0]['savename'];
                }
            }
            $m_ad=M('ad');
            if($id){
                $map['id']=$id;
                $ad=$m_ad->find($id);
                if($m_ad->where($map)->save($data)){
                    @unlink(__UPLOAD__.'/pictures/'.$ad['ad_img']);
                    echo json_encode(array("status" => 1, "info" => "广告修改成功",'url'=>U('Siteinfo/adindex')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "广告修改失败"));
                    exit;
                }
            }else{
                if($m_ad->add($data)){
                    echo json_encode(array("status" => 1, "info" => "广告添加成功",'url'=>U('Siteinfo/adindex')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "广告添加失败"));
                    exit;
                }
            }
        }else{
            $m_page=M('ad');
            $map['id']=$this->_get('id');
            $info=$m_page->where($map)->find();
            $this->assign('info',$info);
            $pagelist = new Category('Page', array('id', 'parent_id', 'page_name', 'fullname'));
            $this->assign("pagelist", $pagelist->getList());
            $this->display();
        }
    }
    /**
     * 删除单条广告
     */
    public function delad(){
        $id=$this->_get('id');
        if(!$id){
            return false;
        }
        $map['id']=$id;
        $M=M('ad');
        if($M->where($map)->delete()){
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        }else{
            echo json_encode(array("status" =>0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }

    /**
     * 文件管理
     */
    public function file_index(){
        $this->display();
    }
    /**
     * 标签管理
     */
    public function  tag_index(){
        $m_tag=M('tag');
        $count = $m_tag->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $list=$m_tag->field('id,name,unique_id,lang')->order('id DESC')->select();
        $this->assign("page", $showPage);
        $this->assign("list",$list);
        $this->display();
    }

    /**
     * 添加修改标签
     */
    public function add_tag(){
        if(IS_POST){
            $m_tag=M('tag');
            $data['lang']=$this->_post('lang');
            $data['name']=$this->_post('name');
            $data['unique_id']=$this->_post('unique_id');
            $data['content']=$_POST['content'];
            $id=$this->_post('id');
            if(!$data['name']){
                echo json_encode(array("status" => 0, "info" => "名称不能为空"));
                exit;
            }
            $s['unique_id']=$data['unique_id'];
            if($data['lang'])$s['lang']=$data['lang'];else unset($data['lang']);
            $s['id']=array('neq',$id);
            if($m_tag->where($s)->count()>0){
                echo json_encode(array("status" => 0, "info" => "同一种语言标识不能重复，请修改"));
                exit;
            }
            if(!ctype_alpha($data['unique_id'])){
                echo json_encode(array("status" => 0, "info" => "标识须为全字母组合"));
                exit;
            }

            if($id){
                $map['id']=$id;
                if($m_tag->where($map)->save($data)){
                    echo json_encode(array("status" => 1, "info" => "更新成功",'url'=>U('Siteinfo/tag_index')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "更新失败"));
                    exit;
                }
            }else{

                if($m_tag->add($data)){
                    echo json_encode(array("status" => 1, "info" => "添加成功",'url'=>U('Siteinfo/tag_index')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "添加失败"));
                    exit;
                }
            }
        }else{
            $m_tag=M('tag');
            $id=$this->_get('id');
            $info=$m_tag->where('id='.$id)->find();
            $this->assign('info',$info);
            $this->display();
        }
    }
    /**
     * 删除单条标签
     */
    public function deltag(){
        $id=$this->_get('id');
        if(!$id){
            return false;
        }
        $map['id']=$id;
        $M=M('tag');
        if($M->where($map)->delete()){
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        }else{
            echo json_encode(array("status" => 0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }
/*
 * 创建模版标签
 */
    public function create_tag(){
        if(IS_POST){
            $list_type=$this->_post('list_type');
            $limit=$this->_post('limit');
            $type=$this->_post('type');
            $order=$this->_post('order');
            $content_type=$this->_post('content_type');
            $str='';
            if($list_type=='n'){$str.='<news ';}else{$str.='<product ';}
            if($limit){$str.=' limit="'.$limit.'" ';}else{
                json_encode(array("status" => 0, "info" =>'请填写显示数量' ));
            }
            if($type!='is_recommend'){$str.='order="'.$type.' '.$order.'" ';
                if($content_type){
                    $str.=' where="cid='.$content_type.'" ';
                }
            }else{
                if($content_type){
                    $str.=' where="is_recommend=1 AND cid='.$content_type.'" ';
                }else{
                    $str.=' where="is_recommend=1" ';
                }
                $str.='order="id '.$order.'"';
            }
            $str.=' >';
            $str.='<p>';
            if($list_type=='n'){$str.='{$new.id}-{$new.title}';}else{$str.='{$pro.id}-{$pro.title}';}
            $str.='</p>';
            if($list_type=='n'){$str.='</news>';}else{$str.='</product>';}
          echo json_encode(array("status" => 1, "info" =>$str));
        }
        else
        {
            import("Category");
            $map['type']='n';
            $cat = new Category('Category', array('cid', 'pid', 'name', 'fullname'),$map);
            $this->assign('newcat',$cat->getList());
           // return $cat->getList();               //获取分类结构
            $this->display();
        }
    }

    public function selectCat(){
        import("Category");
        $map['type']=strval($_GET['t']);
        $cat = new Category('Category', array('cid', 'pid', 'name', 'fullname'),$map);
        $cat=$cat->getList();
        $str='<option value="">全部</option>';
        foreach($cat as $vo){
            $str.='<option value="'.$vo['cid'].'">'.$vo['fullname'].'</option>';
        }
        echo json_encode(array("status" => 1, "info" => $str));
    }
    /*
     * 友情链接
     */
    public function link_index(){
        $M = M("link");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $list=$M->order('id desc')->limit("$page->firstRow, $page->listRows")->select();
        $this->assign("page", $showPage);
        $this->assign("list",$list);
        $this->display();

    }

    public function add_link(){
        if(IS_POST){
            $data=$_POST['info'];
            $id=$this->_post('id');
            if($data['title']==''){
                echo json_encode(array("status" => 0, "info" => "链接名称不能为空"));
                exit;
            }
            if(false===strpos($data['link'],'http://') && false===strpos($data['link'],'https://')){
                echo json_encode(array("status" => 0, "info" => "链接格式不正确"));
                exit;
            }
            $m_ad=M('link');
            if($id){
                $map['id']=$id;
                $ad=$m_ad->find($id);
                if($m_ad->where($map)->save($data)){
                    echo json_encode(array("status" => 1, "info" => "链接修改成功",'url'=>U('Siteinfo/link_index')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "链接修改失败"));
                    exit;
                }
            }else{
                if($m_ad->add($data)){
                    echo json_encode(array("status" => 1, "info" => "链接添加成功",'url'=>U('Siteinfo/link_index')));
                    exit;
                }else{
                    echo json_encode(array("status" => 0, "info" => "链接添加失败"));
                    exit;
                }
            }


        }else{
            $id=$this->_get('id');
            $map['id']=$id;
            $m_link=M('link');
            $info=$m_link->where($map)->find();
            $this->assign('info',$info);
            $this->display();
        }
    }
    /*
     * 删除链接
     */
    public function dellink(){
        $id=$this->_get('id');
        if(!$id){
            return false;
        }
        $map['id']=$id;
        $M=M('link');
        if($M->where($map)->delete()){
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        }else{
            echo json_encode(array("status" => 0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }

    public function message(){
        $M = M("message");
        $count = $M->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $list=$M->order('id desc')->limit("$page->firstRow, $page->listRows")->select();
        $this->assign("page", $showPage);
        $this->assign("list",$list);
        $this->display();
    }

    public function delmessage(){
        $id=$this->_get('id');
        if(!$id){
            return false;
        }
        $map['id']=$id;
        $M=M('message');
        if($M->where($map)->delete()){
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        }else{
            echo json_encode(array("status" => 0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }
    public function changeMessageStatus(){
        $id=$this->_get('id');
        $m_message=M("message");
        $map['id']=$id;
        $status=$m_message->where($map)->getField('display');
        $data['display']=abs($status-1);
        if($m_message->where($map)->save($data)){
            echo json_encode(array("status" => 1, "info" => '<img src="Public/Img/action_'.$data['display'].'.png" border="0">'));
            exit;
        }
        return false;
    }
	/* 管理员log记录 */
    public function adminlog_index(){
    	$al=D("AdminLog");
    	$count=$al->count();
    	import("ORG.Util.Page");
    	$page=new Page($count,12);
    	$showPage=$page->show();
    	$list=$al->order('l_id desc')->limit("$page->firstRow, $page->listRows")->select();
        $this->assign("page", $showPage);
        $this->assign("list",$list);
        $this->display();
    }
    /* 删除log记录 */
    public function deladminlog(){
    	$l_id=$this->_get('l_id');
    	if(!$l_id){
    		return false;
    	}
    	$map['l_id']=$l_id;
    	$M=D("AdminLog");
    	if($M->where($map)->delete()){
    		echo json_encode(array("status"=>1,"info"=>"删除成功！"));
    	}else{
    		echo json_encode(array("status"=>0,"info"=>"删除失败！"));
    	}
    	
    }
} 