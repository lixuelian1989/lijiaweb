<?php

class ZhaopinAction extends CommonAction {

    public function index() {
        $M = M("Zhaopin");
        //过滤
        $s=array('0','1');
        $map=array();
        if($name=$this->_get('name'))$map['name']=array('like',"%{$name}%");
        if($address=$this->_get('address'))$map['address']=array('like',"%{$address}%");
        
        if(in_array($this->_get('status'),$s))$map['status']=$this->_get('status');
        
        
        //
        $count = $M->where($map)->count();
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 12);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $this->assign("list", D("Zhaopin")->listZhaopin($page->firstRow, $page->listRows,$map));

        $this->display();
    }
    
    /**
     * 发布招聘信息
     */
    public function add() {
        if (IS_POST) {
            $this->checkToken();
            echo json_encode(D("Zhaopin")->addZhaopin());
        } else {
            $this->display();
        }
    }

    public function checkNewsTitle() {
        $M = M("Zhaopin");
        $where = "name='" . $this->_get('title') . "'";
        if (!empty($_GET['id'])) {
            $where.=" And id !=" . (int) $_GET['id'];
        }
        if(empty($_GET['title'])){
            echo json_encode(array("status" => 0, "info" => "职位名称不能为空"));
        }
        if ($M->where($where)->count() > 0) {
            echo json_encode(array("status" => 0, "info" => "已经存在，请修改职位名称"));
        } else {
            echo json_encode(array("status" => 1, "info" => "可以使用"));
        }
    }

    public function edit() {
        $M = M("Zhaopin");
        if (IS_POST) {
            $this->checkToken();
        	$img='';
            echo json_encode(D("Zhaopin")->edit());
        } else {
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if ($info['id'] == '') {
                $this->error("不存在该记录");
            }
            $this->assign("info", $info);
            
            $this->display("add");
        }
    }

    public function del() {
        if (M("Zhaopin")->where("id=" . (int) $_GET['id'])->delete()) {
            echo json_encode(array("status" => 1, "info" =>'删除成功'));
        } else {
            echo json_encode(array("status" => 0, "info" =>'删除失败，可能是不存在该ID的记录'));
        }
    }

    public function changeStatus(){
        $id=$this->_get('id');
        $m_news=M("Zhaopin");
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