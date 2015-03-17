<?php

/**
  +------------------------------------------------------------------------------
 * 车辆接口
  +------------------------------------------------------------------------------
 * @category   Action
 * @package  Lib
 * @subpackage  Action
 * @author   yangshuai <ysainjh@163.com>
 * @version  $Id: MemberAction.class.php 2791 2013/12/10  yangshuai $
  +------------------------------------------------------------------------------
 */
class CarAction extends CommonAction {

    //添加新车辆接口
    public function add($field) {
        $request = json_decode($field);
        $infos = $this->do_post($request);

        $this->response->head->res_code = "0001";
        $this->response->head->res_msg = "error";
        $this->response->body->field = "[]";

        if ($infos['msg'] != 'success') {
            $this->response->body->field = $infos['msg'];
            return $this->ajaxReturn($this->response);
            exit;
        }
        //添加新车
        $carMod = D('Car');
        $res = $carMod->add($infos['data']);
        $id = $carMod->getLastInsID();
        //添加成功
        if ($res) {
            $this->response->head->res_code = "0000";
            $this->response->head->res_msg = "success";
            $this->response->body->field = $id;
        }
        return $this->ajaxReturn($this->response);
    }

    //------------------------------------内部处理方法-------------------------
    function do_post($request) {
        $data = array();
        $info = array();

        $data["vin_number"] = $request->vin_number; //VIN 码
        if ($data["vin_number"] == "") {
            $info['msg'] = 'VIN码不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["guobiao"] = $request->guobiao; //国标
        if ($data["guobiao"] == "") {
            $info['msg'] = '国标码不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["car_model"] = $request->car_model; //车型名称
        if ($data["car_model"] == "") {
            $info['msg'] = '车型名称不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["car_jiegou"] = $request->car_jiegou; //车身结构
        if ($data["car_jiegou"] == "") {
            $info['msg'] = '车身结构不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["fdjh"] = $request->fdjh; //发动机号
        if ($data["fdjh"] == "") {
            $info['msg'] = '发动机号不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["chepai_status"] = $request->chepai_status; //车牌状态
        if ($data["chepai_status"] == "") {
            $info['msg'] = '车牌状态不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["chepai_diqu"] = $request->chepai_diqu; //车牌地区
        if ($data["chepai_diqu"] == "") {
            $info['msg'] = '车牌地区不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["chepai_num"] = $request->chepai_num; //车牌号
        if ($data["chepai_num"] == "") {
            $info['msg'] = '车牌号不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["cheliang_type"] = $request->cheliang_type; //车辆类型
        if ($data["cheliang_type"] == "") {
            $info['msg'] = '车辆类型不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["car_paizhao"] = $request->car_paizhao; //车辆牌照
        if ($data["cheliang_type"] == "") {
            $info['msg'] = '车辆牌照不能为空！';
            $info['data'] = array();
            return $info;
            exit;
        }
        $data["fdjhjc"] = $request->fdjhjc; //发动机号检查
        $data["bsxlx"] = $request->bsxlx; //变速箱类型
        $data["pql"] = $request->pql; //排气量
        $data["is_zy"] = $request->is_zy; //是否增压
        $data["yanse"] = $request->yanse; //颜色
        $data["is_yanse_bg"] = $request->is_yanse_bg; //颜色是否变更过
        $data["old_yanse"] = $request->old_yanse; //车身原色
        $data["zhibao"] = $request->zhibao; //新车质保
        $data["bxlc"] = $request->bxlc; //表显里程
        $data["sjlc"] = $request->sjlc; //实际行驶里程
        $data["clbzpz"] = $request->clbzpz; //车辆标准配置
        $data["czgxpz"] = $request->czgxpz; //车主个性配置
        $data["ku_sheng"] = $request->ku_sheng; //车辆库存-省
        $data["ku_shi"] = $request->ku_shi; //车辆库存-市
        $data["ku_qu"] = $request->ku_qu; //车辆库存-区
        $data["chuchang_date"] = $request->chuchang_date; //出厂日期
        $data["zhuce_date"] = $request->zhuce_date; //车辆注册日期
        $data["is_ys"] = $request->is_ys; //是否是一手车
        $data["fp"] = $request->fp; //原始购车发票
        $data["xsb"] = $request->xsb; //行驶本
        $data["djz"] = $request->djz; //登记证
        $data["clxz"] = $request->clxz; //车辆所有人性质
        $data["syxz"] = $request->syxz; //使用性质
        $data["hbbz"] = $request->hbbz; //环保标准
        $data["gzs"] = $request->gzs; //购置税
        $data["ccsdq"] = $request->ccsdq; //车船税到期日
        $data["nianshen_nian"] = $request->nianshen_nina; //年审-年
        $data["nianshen_yue"] = $request->nianshen_yue; //年审-月

        $data["jqx"] = $request->jqx; //强险
        $data["jqx_data"] = $request->jqx_data; //强险到期日
        $data["syx"] = $request->syx; //商业险
        $data["syx_data"] = $request->syx_data; //商业险到期日
        $data['syxje'] = $request->syxje; //商业险金额
        $data["sjhjc"] = $request->sjhjc; //车架号检查
        $data['cys'] = $request->cys; //车钥匙
        $data["baoyangjl"] = $request->baoyangjl; //保养手册记录
        $data["sms"] = $request->sms; //说明书
        $data['ranyou'] = $request->ranyou; //燃油
        $data['gaizhuang'] = $request->gaizhuang; //是否改装
        $data['addtime'] = time();

        $carMod = D("Car");
        $cou = $carMod->check_chepai($data['chepai_num'], $data['chepai_diqu']);
        if ($cou > 0) {
            $info['msg'] = '车辆信息已经存在！';
            $info['data'] = array();
            return $info;
            exit;
        } else {
            $info['msg'] = 'success';
            $info['data'] = $data;
            return $info;
            exit;
        }
    }

}
