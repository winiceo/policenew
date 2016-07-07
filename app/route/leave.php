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
 * @api {post} /leave/create 请假审请
 * @apiDescription 请假审请
 * @apiName createLeave
 * @apiGroup Leave
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.

 * @apiParam {Datetime} start_time 开始时间.
 * @apiParam {Datetime} end_time 结束时间.
 * @apiParam {String} reason 请假原因.
 * @apiSuccess {String} err_code  状态码0为成功.
 * @apiSuccess {String} err_msg 信息提示.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 * "err_code": 0,
 * "err_msg": "success",
 * "data": {
 * "token": {
 * "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA"
 * },
 * "user": {
 * "id": "1",
 * "username": "admin",
 * "email": "admin@71an.com"
 * }
 * }
 * }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 * {
 * "err_code": 1,
 * "err_msg": "登录失败"
 * }
 * @apiSampleRequest /v1/leave/create
 */

$app->map(['POST'], '/create', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $reason = $this->request->getParam('reason');
    $start_time = $this->request->getParam('start_time');
    $end_time = $this->request->getParam('end_time');
    $address = $this->request->getParam('address');

    $plan = \ORM::for_table('users_event')->create();
    $plan->create_time = Carbon::now()->toDateTimeString();
    $plan->user_id = $user_id;
    $plan->type = 1;
    $plan->reason = $reason;
    $plan->start_time = $start_time;
    $plan->end_time = $end_time;
    $plan->address = $address;
    $plan->flow=json_encode(getFlow($user_id)["data"]);
    $plan->check_user_id=getFlow($user_id)["check_user_id"];


    $plan->save();
    $users=explode(";",$plan->check_user_id);
    $tmp=array();
    $tmp['id']=$plan->id;
    $tmp['user_id']=$user_id;
    $tmp['create_time']=$plan->create_time;


    foreach($users as $k=>$v){
        notice($v,1,$tmp);
    }
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);

});


/**
 * @api {post} /leave/update 修改请假信息
 * @apiDescription 更新请假
 * @apiName updateLeave
 * @apiGroup Leave
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.

 * @apiParam {Int} id 记录id.

 * @apiParam {Datetime} start_time 开始时间.
 * @apiParam {Datetime} end_time 结束时间.
 * @apiParam {String} reason 请假原因.
 * @apiSuccess {String} err_code  状态码0为成功.
 * @apiSuccess {String} err_msg 信息提示.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 * "err_code": 0,
 * "err_msg": "success",
 * "data": {
 * "token": {
 * "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA"
 * },
 * "user": {
 * "id": "1",
 * "username": "admin",
 * "email": "admin@71an.com"
 * }
 * }
 * }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 * {
 * "err_code": 1,
 * "err_msg": "登录失败"
 * }
 * @apiSampleRequest /v1/leave/update
 */
$app->map(['POST'], '/update', function ($request, $response, $args) {



    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $id = $this->request->getParam('id');
    $reason = $this->request->getParam('reason');
    $start_time = $this->request->getParam('start_time');
    $end_time = $this->request->getParam('end_time');
    $address = $this->request->getParam('address');

    $plan = \ORM::for_table('users_event')->find_one($id);

    $plan->user_id = $user_id;
    $plan->type = 1;
    $plan->reason = $reason;
    $plan->start_time = $start_time;
    $plan->end_time = $end_time;
    $plan->address = $address;
    $plan->flow=json_encode(getFlow($user_id)["data"]);
    $plan->check_user_id=getFlow($user_id)["check_user_id"];
    $plan->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);

});



/**
 * @api {post} /leave/delete 删除请假
 * @apiDescription 删除请假
 * @apiName deleteLeave
 * @apiGroup Leave
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.

 *@apiParam {Int} id 记录id.

 * @apiSuccess {String} err_code  状态码0为成功.
 * @apiSuccess {String} err_msg 信息提示.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 * "err_code": 0,
 * "err_msg": "success",
 * "data": {
 * "token": {
 * "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA"
 * },
 * "user": {
 * "id": "1",
 * "username": "admin",
 * "email": "admin@71an.com"
 * }
 * }
 * }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 * {
 * "err_code": 1,
 * "err_msg": "登录失败"
 * }
 * @apiSampleRequest /v1/leave/delete
 */
$app->map(['POST','DELETE'], '/delete', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $user_id = $data->id;
    $id = $this->request->getParam('id');


    $plan = \ORM::for_table('users_event')->find_one($id);

    if($plan){
        $plan->delete();
        $res['err_code'] = 0;
        $res['err_msg'] = "删除成功";
    }else{
        $res['err_code'] = 1;
        $res['err_msg'] = "删除失败，记录不存在";
    }


    echo json_encode($res);

});



/**
 * @api {post} /leave/search 查询请假情况
 * @apiDescription 我的请假列表
 * @apiName listLeave
 * @apiGroup Leave
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} page 分页 为空则为1
 * @apiParam {Int} user_id 被查询者id,若为null,则返回全部用户的记录.
 * @apiParam {Datetime} star_time 时间段：开始日期.
 * @apiParam {Datetime} end_time 时间段：结束日期.
 * @apiParam {Int} status 审核状态，1：待审核，2：审核完成，3：审核未通过.
 * @apiSuccess {String} err_code  状态码0为成功.
 * @apiSuccess {String} err_msg 信息提示.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 * "err_code": 0,
 * "err_msg": "success",
 * "data": {
 * "token": {
 * "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NDU5MTgyOTksImp0aSI6ImJFR2Z1ak5Bckp4QXl2UHdPSVFaekV2eEtYT2hrRlwvT1VcL1hzTUlsRXhUdz0iLCJpc3MiOiJwbWtvb19zZWxsZXIiLCJleHAiOjE0NDU5MjU0OTksImRhdGEiOnsiaWQiOiIxIiwibmFtZSI6ImFkbWluIn19.NtZxwC9WoDdnGVjboC1O3RJCcAMsj0D5G3A1vxL0RMMEiSwKC3jPLRMaByCXd9xm6IJw8BH0GLkVnWGvW5_aWA"
 * },
 * "user": {
 * "id": "1",
 * "username": "admin",
 * "email": "admin@71an.com"
 * }
 * }
 * }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 * {
 * "err_code": 1,
 * "err_msg": "登录失败"
 * }
 * @apiSampleRequest /v1/leave/search
 */
$app->map(['GET','POST'], '/search', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
//
    $meid = $data->id;
    $page = $this->request->getParam('page');
    if(!$page){
        $page=1;
    }

    $pageSize=10;


    $type = $this->request->getParam('type');
    $user_id = $this->request->getParam('user_id');
    $star = $this->request->getParam('star_time');
    $end = $this->request->getParam('end_time');
    $status = $this->request->getParam('status');
    $plan = \ORM::for_table('users_event');
    if ($user_id>0) {
        $plan->where_raw(sprintf("`user_id`='%s'",$user_id));

    };
    if ($status>0) {
        $plan->where_raw(sprintf("`status`='%s'",$status));

    };

     $plan->where_raw(sprintf("`type`='%s'",1));

    if($star){
        $plan->where_raw("DATE_FORMAT(create_time,'%Y-%m-%d')>='".$star."'");
    }
    if($end){
        $plan->where_raw("DATE_FORMAT(create_time,'%Y-%m-%d')<='".$end."'");
    }
     $count=rand(1, @ceil($plan->count() / $pageSize));

    $data=$plan->limit($pageSize)->offset(($page-1)*$pageSize)
        ->order_by_desc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data']=array('list'=>$data,'total'=>$count);
    echo json_encode($res);

});