<?php

/**
  +------------------------------------------------------------------------------
 * 84PAI 接口
  +------------------------------------------------------------------------------
 * @category   Action
 * @package  Lib
 * @subpackage  Action
 * @author   yangshuai <ysainjh@163.com>
 * @version  $Id: MemberAction.class.php 2791 2013/12/10  yangshuai $
  +------------------------------------------------------------------------------
 */
class CommonAction extends Action {

    public $response;
    public $request;

    /**
      +----------------------------------------------------------
     * 初始化,调用页面公共信息部分
     * 
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * 
     * 
      +----------------------------------------------------------
     * @return max
      +----------------------------------------------------------
     */
    function _initialize() {
        //指定文档编码格式,默认是utf-8编码
        header('Content-type: text/html; charset=utf8');
        Load('extend');
        //把编码赋值到页面
        $this->assign('charset', C("charset"));
        $response = D("Response");
        $head = D("Head");
        $head->res_code = "0001";
        $head->res_msg = "空操作";
        $head->res_arg = "";
        $body = D("Body");
        $body->field = "";
        $response->head = $head;
        $response->body = $body;
        $this->response = $response;
    }

    //处理post请求
    protected function processPost() {
        //$string=$this->_post("json");
        $string = $_POST['json'];
        $string = stripslashes($string);
        //$string='{"head":{"code":"member_login"},"field":{"username":"test","password":"123456"}}';
        $strarr = json_decode($string);
        if (empty($strarr)) {
            $this->ajaxReturn($this->response);
            exit;
        }
        $this->request = $strarr;

        return $strarr;
    }

    /**
      +----------------------------------------------------------
     * Ajax方式返回数据到客户端
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param mixed $data 要返回的数据
     * @param String $info 提示信息
     * @param boolean $status 返回状态
     * @param String $status ajax返回类型 JSON XML
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     */
    protected function ajaxReturn($data, $type = '') {
        if (func_num_args() > 2) {// 兼容3.0之前用法
            $args = func_get_args();
            array_shift($args);
            $info = array();

            $info['data'] = $data;
            $info['info'] = array_shift($args);
            $info['status'] = array_shift($args);
            $data = $info;
            $type = $args ? array_shift($args) : '';
        }
        if (empty($type))
            $type = C('DEFAULT_AJAX_RETURN');
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
//                 exit(stripslashes($this->decodeUnicode(json_encode($data))));
                exit(($this->decodeUnicode(json_encode($data))));
            case 'XML' :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler . '(' . json_encode($data) . ');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default :
                // 用于扩展其他返回格式数据
                tag('ajax_return', $data);
        }
    }

    public function decodeUnicode($str) {
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function(
                        '$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
                ), $str);
    }

}
