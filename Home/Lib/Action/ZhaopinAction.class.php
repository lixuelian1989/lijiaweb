<?php

/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午12:12
 */
class ZhaopinAction extends BaseAction {

    /**
     * 封面页
     */
    public function index() {
        $model = M("Zhaopin");
        
       //列表--------------------------------------------------------------------start
        $map = array('status' => 1);
        $count = $model->where($map)->count();
        import("ORG.Util.Page"); //载入分页类
        $page = new Page($count, 3);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $list = $model->where($map)->order('addtime desc')->limit("$page->firstRow, $page->listRows")->select();
        foreach ($list as $k=>$v){
            $list[$k]['adddate']=date("Y-m-d",$v['addtime']);
        }  
        $this->assign("list", $list);
        //列表-------------------------------------------------------------------end
        
        $this->assign('webtitle', L('T_Zhaopin'));
        $this->display();
    }

    /**
     * 详情页
     */
    public function read() {
        $id = $this->_get('id');
        $m_news = M('Zhaopin');
        if (!$id) {
            $this->redirect('Zhaopin/index');
        }
        $map['id'] = $id;
        if ($info = $m_news->where($map)->find()) {
            if ($info['status'] == 0) {
                $this->redirect('Zhaopin/index');
            }
            $info['adddate']=date("Y-m-d",$info['addtime']);
            $info['miaoshu']=str_replace("\n", "<br/>", $info['miaoshu']);
            
            $this->assign('info', $info);
            $this->assign('auther', $this->getAuther($info['aid']));
           
           
            $this->assign('webtitle', $info['name'] . '-' . L('T_Zhaopin'));
            $this->display();
        } else {
            $this->redirect('News/index');
        }
    }

    protected function getAuther($id) {
        if (!$id) {
            return '';
        }
        $admin = M('admin');
        $map['aid'] = $id;
        return $admin->where($map)->getField('nickname');
    }

    protected function pages($sumpage, $dqpage) {
        $strinfo = "";
        if ($dqpage != 1) {//上一页
            $strinfo.="<a href='?page=" . ($dqpage - 1) . "'>上一页</a>";
        }


        if ($dqpage <= 3) {
            if($sumpage<=3){
                $xunhuan=$sumpage;
                $lastinfo="";
            }
            else{
                $xunhuan=3;
                $lastinfo="<a href='?page=4'>...</a><a href='&page=".$sumpage."'>".$sumpage."</a>";//后面的字符
            }
            for ($i = 1; $i <= $xunhuan; $i++) {
                if ($dqpage == $i)
                    $strinfo.="<a href='?page=" . $i . "' class='current' >" . $i . "</a>";
                else
                    $strinfo.="<a href='?page=" . $i . "' >" . $i . "</a>";
            }
            $strinfo.=$lastinfo;
        }else {
            $strinfo.="<a href='?page=3'>...</a>";
            if($sumpage>($dqpage+3)){
                $xunhuan=$dqpage+3;
                $lastinfo="<a href='?page=4'>...</a><a href='&page=".$sumpage."'>".$sumpage."</a>";
            }else{
                $xunhuan=$sumpage;
                $lastinfo="";
            }
            
            for ($i = $dqpage; $i <= $xunhuan; $i++) {
                if ($dqpage == $i)
                    $strinfo.="<a href='?page=" . $i . "' class='current' >" . $i . "</a>";
                else
                    $strinfo.="<a href='?page=" . $i . "' >" . $i . "</a>";
            }
            $strinfo.=$lastinfo;
        }


        if ($dqpage != $sumpage) {
            //下一页
            $strinfo.="<a href='?page=" . ($dqpage + 1) . "'>下一页</a>";
        }
        return $strinfo;
    }

}
