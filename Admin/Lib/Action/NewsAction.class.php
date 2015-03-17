<?php

class NewsAction extends CommonAction {

    public function index() {
        $M = M("News");
        //过滤
        $s=array('0','1');
        $map=array();
        if($title=$this->_get('title'))$map['title']=array('like',"%{$title}%");
        if(in_array($this->_get('status'),$s))$map['status']=$this->_get('status');
        if($cid=$this->_get('cid'))$map['cid']=$cid;
        if(in_array($this->_get('is_recommend'),$s))$map['is_recommend']=$this->_get('is_recommend');
        //
        $count = $M->where($map)->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $this->assign("list", D("News")->listNews($page->firstRow, $page->listRows,$map));

        import("Category");
        $map2['type']='n';
        $cat = new Category('Category', array('cid', 'pid', 'name', 'fullname'),$map2);
         $cat->getList();               //获取分类结构
        $this->assign("catlist", $cat->getList());
        $this->display();
    }

    public function category() {
        if (IS_POST) {
            echo json_encode(D("News")->category());
        } else {
            $this->assign("list", D("News")->category());
            $this->display();
        }
    }

    public function add() {
        if (IS_POST) {
            $this->checkToken();
       		$img='';
            if($_FILES['upfile']['name']){
                $dir='./Uploads/product/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload($dir)){
                    $img=date('Ym').'/'.$image[0]['savename'];
                }
            }
            echo json_encode(D("News")->addNews($img));
        } else {
            $this->assign("list", D("News")->category());
            $this->display();
        }
    }

    public function checkNewsTitle() {
        $M = M("News");
        $where = "title='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And id !=" . (int) $_GET['id'];
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

    public function edit() {
        $M = M("News");
        if (IS_POST) {
            $this->checkToken();
        	$img='';
            if($_FILES['upfile']['name']){
                $dir='./Uploads/product/'.date('Ym').'/';
                makeDir($dir);
                if($image=$this->upload($dir)){
                    $img=date('Ym').'/'.$image[0]['savename'];
                }
            }
            
            echo json_encode(D("News")->edit($img));
        } else {
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if ($info['id'] == '') {
                $this->error("不存在该记录");
            }
            $this->assign("info", $info);
            $this->assign("list", D("News")->category());
            $this->display("add");
        }
    }

    public function del() {
        if (M("News")->where("id=" . (int) $_GET['id'])->delete()) {
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
        $m_news=M("News");
        $map['id']=$id;
        $status=$m_news->where($map)->getField('status');
        $data['status']=abs($status-1);
        $statusArr = array("待审核", "已发布");
        if($m_news->where($map)->save($data)){
            echo json_encode(array("status" => 1, "info" => $statusArr[$data['status']]));
            //echo '<img src="../Public/Img/action_'.$data['is_recommend'].'.png" border="0">';
            exit;
        }
        return false;
    }

}