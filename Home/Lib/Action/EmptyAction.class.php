<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 13-11-7
 * Time: 下午2:28
 */
class EmptyAction extends BaseAction{
    public function index(){
        //根据当前模块名来判断要执行那个城市的操作
        $cityName = MODULE_NAME;
       echo '404';
    }
}