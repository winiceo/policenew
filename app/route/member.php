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
 * @api {post} /member/list 用户列表
 * @apiDescription 管理员操作，显示所有用户
 * @apiName memberList
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSuccess {String} err_code  状态码0为成功.
 * @apiSuccess {String} err_msg 信息提示.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 * {
 * err_code: 0,
 * err_msg: "",
 * data: [
 * {
 * id: "1",
 * username: "admin",
 * email: "admin@71an.com",
 * group: "admin"
 * },
 * {
 * id: "19",
 * username: "leven",
 * email: "611796279@qq.com",
 * group: null
 * },
 * {
 * id: "20",
 * username: "chenshi",
 * email: "chenshi@qq.com",
 * group: null
 * }
 * ]
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
 * @apiSampleRequest /v1/member/list
 */


$app->map(['GET', 'POST'], '/list', function ($request, $response, $args) {

    $res = array();
    // $data = check($this->request);

    $members = \ORM::for_table('users');

    $data = $members->order_by_asc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $data;
    echo json_encode($res);

});


/**
 * @api {post} /member/create 添加用户
 * @apiDescription 添加用户
 * @apiName createMember
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {String} username 用户名.
 * @apiParam {String} password 密码.


 * @apiParam {String} job 职位.
 * @apiParam {String} real_name 真实姓名.
 * @apiParam {String} avatar_path 图像地址.
 * @apiParam {Int} sex 性别 1男，2女


 * @apiParam {String} department_id 部门id.
 * @apiParam {String} secondary_department_name 二级部门名称.
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
 * @apiSampleRequest /v1/member/create
 */

$app->map(['GET', 'POST'], '/create', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    checkAdmin($data,array(1,2,6));
    $user_id = $data->id;
    $username = $this->request->getParam('username');
    $password = md5(trim($this->request->getParam('password')));

    $job = $this->request->getParam('job');

    $department_id = $this->request->getParam('department_id');

    $secondary_department_name = $this->request->getParam('secondary_department_name');

    $real_name=$this->request->getParam('real_name');
    $sex=$this->request->getParam('sex');
    $avatar_path=$this->request->getParam('avatar_path');

    $plan = \ORM::for_table('users')->create();
    $plan->create_time = Carbon::now()->toDateTimeString();
    $plan->username = $username;
    $plan->password = $password;


    $plan->job = $job;
    $plan->level=getJob(trim($job))["sign"];

    $plan->department_id = $department_id;

    $plan->real_name=$real_name;
    $plan->sex=$sex;
    $plan->avatar_path=$avatar_path;
    $plan->secondary_department_name=$secondary_department_name;
    $plan->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);
});


/**
 * @api {post} /member/update 更新用户
 * @apiDescription 更新用户资料
 * @apiName updateMember
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 用户id.
 * @apiParam {String} username 用户名.



 * @apiParam {String} job 职位.
 * @apiParam {String} real_name 真实姓名.
 * @apiParam {String} avatar_path 图像地址.
 * @apiParam {Int} sex 性别 1男，2女
 * @apiParam {String} department_id 部门id.
 * @apiParam {String} secondary_department_name 二级部门名称.
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
 * @apiSampleRequest /v1/member/update
 */
$app->map(['POST'], '/update', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    checkAdmin($data,array(1,2,6),true);
    $user_id = $data->id;
    $id = $this->request->getParam('id');
    $username = $this->request->getParam('username');
    $password = md5(trim($this->request->getParam('password')));

    $job = $this->request->getParam('job');

    $department_id=$this->request->getParam('department_id');
    $real_name=$this->request->getParam('real_name');
    $sex=$this->request->getParam('sex');
    $avatar_path=$this->request->getParam('avatar_path');
    $secondary_department_name = $this->request->getParam('secondary_department_name');


    $plan = \ORM::for_table('users')->find_one($id);
    $plan->create_time = Carbon::now()->toDateTimeString();
    $plan->username = $username;


    $plan->job = $job;
    $plan->level=getJob(trim($job))["sign"];

    $plan->department_id = $department_id;

    $plan->real_name=$real_name;
    $plan->sex=$sex;
    $plan->avatar_path=$avatar_path;
    $plan->secondary_department_name=$secondary_department_name;

    $plan->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);

});


/**
 * @api {post} /member/change_pwd 更新用户
 * @apiDescription 更新用户资料
 * @apiName changPwd
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.

 * @apiParam {Int} user_id 用户id.
 * @apiParam {String} password 密码.


 * @apiSampleRequest /v1/member/change_pwd
 */
$app->map(['POST',"GET"], '/change_pwd', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    checkAdmin($my,array(1,2,6));
    $password = md5(trim($this->request->getParam('password')));
    $user_id = trim($this->request->getParam('user_id'));

    if($password&&$user_id){
        $plan = \ORM::for_table('users')->find_one($user_id);
        if($plan){
            $plan->password = $password;

            $plan->save();
            $res['err_code'] = 0;
            $res['err_msg'] = "修改密码成功";
        }else{

            $res['err_code'] = 1;
            $res['err_msg'] = "修改密码失败";
        }

    }else{
        $res['err_code'] = 1;
        $res['err_msg'] = "修改密码失败";
    }

    echo json_encode($res);

});


/**
 * @api {post} /member/delete 删除用户
 * @apiDescription 管理员操作，删除用户
 * @apiName deleteMember
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 用户id.
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
 * @apiSampleRequest /v1/member/delete
 */

$app->map(['POST', 'DELETE'], '/delete', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    checkAdmin($data,array(1,2,6));
    $user_id = $data->id;
    $id = $this->request->getParam('id');


    $plan = \ORM::for_table('users')->find_one($id);

    if ($plan) {
        $plan->delete();
        $res['err_code'] = 0;
        $res['err_msg'] = "删除成功";
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "删除失败，记录不存在";
    }
    echo json_encode($res);

});


/**
 * @api {post} /member/change_password 更新自己密码
 * @apiDescription 更新用户自己的密码
 * @apiName changePassword
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 *
 * @apiParam {String} password 密码.
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
 * @apiSampleRequest /v1/member/change_password
 */
$app->map(['POST'], '/change_password', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $id = $data->id;

    //$username = $this->request->getParam('username');
    $password = md5(trim($this->request->getParam('password')));
    // $email = $this->request->getParam('email');

    $plan = \ORM::for_table('users')->find_one($id);

    $plan->password = $password;

    $plan->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);

});


/**
 * @api {post} /member/profile 根据Id获取用户的信息
 * @apiDescription 根据Id获取用户的信息
 * @apiName getProfile
 * @apiGroup Member
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 *
 * @apiParam {Int} user_id  要获取的用户id，若为空则返回当前登录用户.
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
 * @apiSampleRequest /v1/member/profile
 */
$app->map(['POST'], '/profile', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $id = $this->request->getParam('user_id');
    if (!$id) {
        $id = $data->id;
    }


    $user = \ORM::for_table('users')->find_one($id)->as_array();


    if ($user) {
        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data'] = $user;

    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "用户不存在";
    }

    echo json_encode($res);
});


