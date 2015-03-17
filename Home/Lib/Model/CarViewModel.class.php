<?php
class CarViewModel extends ViewModel  {
	public $viewFields =array(
            "Car"=>array("id","vin_number","guobiao","car_model","car_jiegou"=>"jiegou","fdjh","chepai_status","chepai_diqu","chepai_num","cheliang_type","car_paizhao",
                "fdjhjc","bsxlx","pql","is_zy","yanse","is_yanse_bg","old_yanse","zhibao","bxlc",
                "sjlc","clbzpz","czgxpz","ku_sheng","ku_shi","ku_qu","chuchang_date","zhuce_date","is_ys","fp","xsb","djz","clxz","syxz","hbbz","gzs","ccsdq","nianshen_nian"=>"nianshen_n",
                "nianshen_yue"=>"nianshen_y","jqx","jqx_data","syx","syx_data","syxje","sjhjc","cys","baoyangjl","sms","ranyou","gaizhuang","addtime","fuwufangshi","pmfs","cjqx","weituopeo",
                "weituosex","weituophone","baoliujia","dailifuwu_fee","qipai_fee","mai_fee"=>"mai_fee",
                "shouxu","memid","status"=>"s",
                "_type"=>"LEFT"),
            "Carimg"=>array("img_url","img_thumb_url","_on"=>"Car.id=Carimg.car_id")
        );
	
}
?>