<?php

/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午12:12
 */
class NewsAction extends BaseAction {

    /**
     * 封面页
     */
    public function index() {
        $N = M("News");

        $newlist1 = $N->where(array("cid" => 1, "status" => 1))->order("click desc , update_time desc ")->limit(3)->select(); //84动态
        $newlist2 = $N->where(array("cid" => 2, "status" => 1))->order("click desc , update_time desc ")->limit(3)->select(); //84动态
        $newlist3 = $N->where(array("cid" => 3, "status" => 1))->order("click desc , update_time desc ")->limit(3)->select(); //84动态
        $newlist4 = $N->where(array("cid" => 4, "status" => 1))->order("click desc , update_time desc ")->limit(3)->select(); //84动态

        $this->assign("newlist1", $newlist1);
        $this->assign("newlist2", $newlist2);
        $this->assign("newlist3", $newlist3);
        $this->assign("newlist4", $newlist4);


        $this->assign("ad_info", $this->getAd());
        $this->assign('webtitle', L('T_NEWS'));
        $this->display();
    }

    /**
     * 列表页
     */
    public function newslist() {
        $model = M("News");
        $cid = $_GET['cid'];
        $catmodel = M("Category");
        $catinfo = $catmodel->where(array('cid' => $cid))->find();

        //列表--------------------------------------------------------------------start
        $map = array('cid' => $cid, 'status' => 1);
        $count = $model->where($map)->count();
        import("ORG.Util.Page"); //载入分页类
        $page = new Page($count, 2);
        $showPage = $page->show();
        $this->assign("page", $showPage);
        $list = $model->where($map)->order('click desc,update_time desc')->limit("$page->firstRow, $page->listRows")->select();
        
        foreach ($list as $k => $v) {
            $list[$k]['imgsrc'] = empty($v['imgsrc']) ? __ROOT__ . "/Home/Tpl/default/Public/images/zc_img27.jpg" : __ROOT__ . "/Uploads/product/" . $v['imgsrc'];
        }
        $this->assign("list", $list);
        //列表-------------------------------------------------------------------end



        $this->assign('catname', $catinfo['name']);
        $this->assign('webtitle', $catinfo['name'] . "-" . L('T_NEWS'));
        $this->display();
    }

    /**
     * 详情页
     */
    public function read() {
        $id = $this->_get('id');
        $m_news = M('news');
        if (!$id) {
            $this->redirect('News/index');
        }
        $map['id'] = $id;
        if ($info = $m_news->where($map)->find()) {
            if ($info['status'] == 0) {
                $this->redirect('News/index');
            }
            $C = M("Category");
            $map2['cid'] = $info['cid'];
            $info['cname'] = $C->where($map2)->getField('name');
            $this->assign('info', $info);
            $this->assign('auther', $this->getAuther($info['aid']));
            $m_news->where($map)->setInc('click', 1);
            //给内容分页-----------------------------
            $content_arr = explode('_ueditor_page_break_tag_', $info['content']);
            $sumpage = count($content_arr);
            $dqpage = $_GET['page'] == 0 ? 1 : $_GET['page'];
            $this->assign('content', $content_arr[$dqpage - 1]);
            
            $this->assign('pages',$this->pages($sumpage, $dqpage));

            $this->assign('webtitle', $info['title'] . '-' . L('T_NEWS'));
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
