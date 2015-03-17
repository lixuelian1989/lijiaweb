<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午12:12
 */

class LawssystemAction extends CommonAction {
    /**
     * 列表页
     */
    public function index(){
        $this->check_login();
        
        $this->assign("ad_info", $this->getAd());
        $this->assign('webtitle',L('T_Lawssystem'));
        //国家
        $lcMod=D("Lawscountry");
        $lc_list=$lcMod->get_list_all($lang);
        $this->assign("lc_list",$lc_list);
        //法规类型
        $ltMod=D("Lawstype");
        $lt_list=$ltMod->get_list_all($lang);
        $this->assign("fglx_str",$this->get_fglx($lt_list));
        
        
        
        //车型
        $lmMod=D("Lawsmodule");
        $lm_list=$lmMod->get_list_all($lang);
        $this->assign("lm_str",$this->get_module($lm_list));
        
        
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
    /**
     * 获取字符串---法规类型
     */
    public function get_fglx($list){
    	$str="<table>";
    	$str.='<tr>';
    	foreach ($list as $k=>$v){
    		
        	$str.='<td style="text-align:right"><input type="checkbox" name="lt_id[]" value="'.$v['lt_id'].'" /></td>';
        	$str.='<td style="text-align:left">'.$v['lt_name'].'</td>';
        	if(($k+1)%2==0)
      		$str.='</tr><tr>';
    	}
    	$str.="</tr>";
    	$str.="</table>";
    	return $str;    	
    }
	
    /**
     * 获取车型
     */
    public function get_module($list){
    	$str="<table>";
    	$str.='<tr>';
    	foreach ($list as $k=>$v){
    		
        	$str.='<td style="text-align:right"><input type="checkbox" name="lm_id[]" value="'.$v['lm_id'].'" /></td>';
        	$str.='<td style="text-align:left">'.$v['lm_name'].'</td>';
        	if(($k+1)%2==0)
      		$str.='</tr><tr>';
    	}
    	$str.="</tr>";
    	$str.="</table>";
    	return $str;    	
    }
} 