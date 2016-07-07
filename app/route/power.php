<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/7/7
 * Time: 下午7:58
 */
/**
 * @apiDefine member User access only
 * 登录后的用户可以操作.
 */

include_once ROOT . '/app/lib/pmkoo.php';
include_once ROOT . '/app/route/func.php';

use Carbon\Carbon;


/**
 * @api {post} /power/list 用户列表
 * @apiDescription 管理员操作，显示所有用户,权限1:创建审批;2:派出所意见审批;3;治安大队意见审批;4;局领导意见审批
 * @apiName powerList
 * @apiGroup Power
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSuccess {String} err_code  状态码0为成功.
 * @apiSuccess {String} err_msg 信息提示.
 * @apiSampleRequest /v1/power/list
 */


$app->map(['GET', 'POST'], '/list', function ($request, $response, $args) {

    $res = array();
    // $data = check($this->request);

    $members = \ORM::for_table('users');

    $data = $members->order_by_asc('id')->find_array();


    foreach ($data as $key => $value) {
        $power = \ORM::for_table("users_power")->select("power_level")->where("user_id", $value["id"])->find_array();
        $tmp = array();
        foreach ($power as $k => $v) {
            $tmp[] = $v["power_level"];
        }
        $data[$key]["power"] = join(",", $tmp);
    }
    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $data;
    echo json_encode($res);

});


/**
 * @api {post} /power/set 更新权限
 * @apiDescription 有记录则删除,无记录再添加
 * @apiName powerSet
 * @apiGroup Power
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} user_id 用户id,
 * @apiParam {Int}  power_level 权限值,逗号分隔,1:创建审批;2:派出所意见审批;3;治安大队意见审批;4;局领导意见审批
 * @apiSampleRequest /v1/power/set
 */

$app->map(['POST', "GET"], '/set', function ($request, $response, $args) {

    $res = array();
   $my = check($this->request);

    $user_id = $this->request->getParam('user_id');
    $power_level = $this->request->getParam('power_level');


    $obj = \ORM::for_table('users_power');
    $rs = $obj->where("user_id", $user_id)->find_many();

    if ($rs) {
        $rs->delete();
    };


    $tmp = explode(",", $power_level);
    $user=getUserInfo($user_id);

    foreach ($tmp as $key => $value) {
        if(intval($value)>0){
            $obj = $obj->create();
            $obj->user_id = $user_id;
            $obj->power_level = intval($value);
            $obj->act_id = $my->id;
            $obj->dep_id=$user["department_id"];
            $obj->save();
        }

    }


    $res['err_code'] = 0;
    $res['err_msg'] = "更新权限成功";
    $res['sql'] = ORM::get_last_query();
    echo json_encode($res);

});



/**
 * @api {post} /power/get 获取当前用登录用户权限
 * @apiDescription 获取当前用登录用户权限
 * @apiName powerGet
 * @apiGroup Power
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/power/get
 */

$app->map(['POST', "GET"], '/get', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);



    $obj = \ORM::for_table('users_power');
    $rs = $obj->where("user_id", $my->id)->find_array();
    $tmp = array();
    if ($rs) {

        foreach ($rs as $k => $v) {
            $tmp[] = $v["power_level"];
        }

    };
    $res['err_code'] = 0;

    $res['data'] = $tmp;
    echo json_encode($res);

});

