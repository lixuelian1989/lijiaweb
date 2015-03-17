<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午12:12
 */

class NewsAction extends BaseAction {
    /**
     * 列表页
     */
    public function index(){
        $N = M("News");
        $C = M("Category");
        $cid=$this->_get('cid');
        /*if($cid){
        $map['n.cid']=$cid;
        }*/
        
        $map['n.cid']=74;
        
        $map['n.status']=1;
        $map['n.lang']=LANG_SET;
        $count = $N->table($N->getTableName().' n')
            ->join($C->getTableName().' c on c.cid=n.cid')
            ->field('n.id')
            ->where($map)->count();
        import("ORG.Util.Page"); //载入分页类
        $page = new Page($count,C('LISTNUM.newslist'));
        $showPage = $page->show();
      
        $this->assign("page", $showPage);
        $list=$N->table($N->getTableName().' n')
            ->join($C->getTableName().' c on c.cid=n.cid')
            ->field('n.id,n.cid,n.title,n.imgsrc,n.summary,n.update_time,n.click,c.name as cname,n.published')
            ->where($map)->order('id desc')->limit("$page->firstRow, $page->listRows")->select();
        foreach ($list as $k=>$v){
        	$list[$k]['imgsrc']=empty($v['imgsrc'])?__ROOT__."/Home/Tpl/default/Public/images/new_03.jpg":__ROOT__."/Uploads/product/".$v['imgsrc'];
        }    
            
        $this->assign("list", $list);
        
        
        
        $this->assign("ad_info", $this->getAd());
        $this->assign('webtitle',L('T_NEWS'));
        $this->display();
    }
    /**
     * 详情页
     */
    public function read(){
        $id=$this->_get('id');
        $m_news=M('news');
        if(!$id){$this->redirect('News/index');}
        $map['id']=$id;
        if($info=$m_news->where($map)->find()){
            if($info['status']==0){
                $this->redirect('News/index');
            }
            $C = M("Category");
            $map2['cid']=$info['cid'];
            $info['cname']=$C->where($map2)->getField('name');
            $this->assign('info',$info);
            $this->assign('auther',$this->getAuther($info['aid']));
            $m_news->where($map)->setInc('click',1);
            $this->assign('webtitle',$info['title'].'-'.L('T_NEWS'));
            $this->display();
        }else{
            $this->redirect('News/index');
        }
    }
    protected function getAuther($id){
        if(!$id){return '';}
        $admin=M('admin');
        $map['aid']=$id;
        return $admin->where($map)->getField('nickname');
    }

} 