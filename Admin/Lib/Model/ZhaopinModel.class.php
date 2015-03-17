<?php

class ZhaopinModel extends Model {

    public function listZhaopin($firstRow = 0, $listRows = 20,$map) {
        $M = M("Zhaopin");
        $list = $M->where($map)->order("`addtime` DESC")->limit("$firstRow , $listRows")->select();
        $statusArr = array("待审核", "已发布");
        $aidArr = M("Admin")->field("`aid`,`email`,`nickname`")->select();
        foreach ($aidArr as $k => $v) {
            $aids[$v['aid']] = $v;
        }
        unset($aidArr);
        foreach ($list as $k => $v) {
            $list[$k]['aidName'] =$aids[$v['aid']]['nickname'] == '' ? $aids[$v['aid']]['email'] : $aids[$v['aid']]['nickname'];
            $list[$k]['status'] = $statusArr[$v['status']];
            $list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            
        }
        return $list;
    }

    public function category() {
        if (IS_POST) {
            $act = $_POST[act];
            $data = $_POST['data'];
            $data['name'] = addslashes($data['name']);
            $M = M("Category");
            if ($act == "add") { //添加分类
                unset($data[cid]);
                $data['type']= $_POST['type'];
                if ($M->where($data)->count() == 0) {
                    return ($M->add($data)) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功添加到系统中', 'url' => U('News/category', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 添加失败');
                } else {
                    return array('status' => 0, 'info' => '系统中已经存在分类' . $data['name']);
                }
            } else if ($act == "edit") { //修改分类
                if (empty($data['name'])) {
                    unset($data['name']);
                }
                if ($data['pid'] == $data['cid']) {
                    unset($data['pid']);
                }
                return ($M->save($data)) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功更新', 'url' => U('News/category', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 更新失败');
            } else if ($act == "del") { //删除分类
                unset($data['pid'], $data['name']);

                if($M->where('pid='.$data['cid'].' AND cid!='.$data['cid'])->count()>0){
                    return (array('status' => 0, 'info' => $data['name'] . '存在下级分类，请先删除'));
                    exit;
                }

                return ($M->where($data)->delete()) ? array('status' => 1, 'info' => '分类 ' . $data['name'] . ' 已经成功删除', 'url' => U('News/category', array('time' => time()))) : array('status' => 0, 'info' => '分类 ' . $data['name'] . ' 删除失败');
            }
        } else {
            import("Category");
            $map['type']='n';
            $cat = new Category('Category', array('cid', 'pid', 'name', 'fullname'),$map);
            return $cat->getList();               //获取分类结构
        }
    }
    /**
     * 添加招聘
     * @return type
     */
    public function addZhaopin() {
        $M = M("Zhaopin");
        $data = $_POST['info'];
        $data['name']=strip_tags($data['name']);
        $data['addtime'] = time();
        
        if(empty($data['name'])){
            return array('status' => 0, 'info' => "请输入招聘名称！",'url'=>__SELF__);
        }
        $data['aid'] = $_SESSION['my_info']['aid'];
        
        if ($M->add($data)) {
            return array('status' => 1, 'info' => "已经发布", 'url' => U('Zhaopin/index'));
        } else {
            return array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作");
        }
    }

    public function edit() {
        $M = M("Zhaopin");
        $data = $_POST['info'];
        $data['name']=strip_tags($data['name']);
        $data['addtime'] = time();
        
        if(empty($data['name'])){
            return array('status' => 0, 'info' => "请输入招聘标题！",'url'=>__SELF__);
        }
        if ($M->save($data)) {
            return array('status' => 1, 'info' => "已经更新", 'url' => U('Zhaopin/index'));
        } else {
            return array('status' => 0, 'info' => "更新失败，请刷新页面尝试操作");
        }
    }

}

?>
