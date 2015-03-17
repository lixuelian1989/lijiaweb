<?php

class CarModel extends ViewModel {
    //检查车牌号是否存在
    function check_chepai($chepai,$chepaidiqu){
        $map=array();
        $map['chepai_diqu']=$chepaidiqu;
        $map['chepai_num']=$chepai;
        return $this->where($map)->count();
    }
}
