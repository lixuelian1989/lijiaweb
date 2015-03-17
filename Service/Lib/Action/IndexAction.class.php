<?php

/**
  +------------------------------------------------------------------------------
 * 前台动作默认动作类
  +------------------------------------------------------------------------------
 * @category   Action
 * @package  Lib
 * @subpackage  Action
 * @author   zhujiangtao <tiger6681517@qq.com>
 * @version  $Id: IndexAction.class.php 2791 2013/7/29  zhujiangtao $
  +------------------------------------------------------------------------------
 */
class IndexAction extends CommonAction {

    //总的service 入口
    public function index() {
       
        $request = $this->processPost();
        #var_dump($request);exit;
        $head = $request->head;
        $code = $head->code;
        $codearr = explode("_", $code);
        $field = $request->field;
        //处理编码问题
// 		foreach ($field as $key=> $val){
// 			$field->$key=mb_convert_encoding($val,'UTF-8',  array('ASCII', 'UTF-8', 'GBK', 'GB2312', 'BIG5'));
// 		}
        $module = $codearr[0];
        $action = $codearr[1];
        #var_dump($module);
        #var_dump($action);exit;
        $module = ucfirst($module);

        R($module . "/" . $action, array("field" => json_encode($field)));
        //$this->display();
    }

    public function test() {

        $this->display();
    }

    public function testAct() {
        $request = $this->processPost();
        $head = $request->head;
        $code = $head->code;
        $codearr = explode("_", $code);
        $field = $request->field;
// 		//处理编码问题
// 		foreach ($field as $key=> $val){
// 			$field->$key=mb_convert_encoding($val,'UTF-8',  array('ASCII', 'UTF-8', 'GBK', 'GB2312', 'BIG5'));
// 		}
        $module = $codearr[0];
        $action = $codearr[1];
        $module = ucfirst($module);
        R('T' . $module . "/" . $action, array("field" => json_encode($field)));
        //$this->display();
    }

    /**
      +----------------------------------------------------------
     * 检查用户是否登录,是否有权限
     * 
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * 
     * 
      +----------------------------------------------------------
     * @return HashMap
      +----------------------------------------------------------
     */
    protected function checkUser() {
        $user_id = session('user_id');

        if (empty($user_id)) {
            $this->redirect('User/login');
        }
    }

}
