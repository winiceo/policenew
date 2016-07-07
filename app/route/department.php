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
 * @api {post} /department/create 添加部门
 * @apiDescription 添加部门
 * @apiName createDep
 * @apiGroup Department
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.


 * @apiParam {String} name 部门名称.
 * @apiParam {String} children_name 子部门名称，以英文逗号分隔.

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
 * @apiSampleRequest /v1/department/create
 */

$app->map(['POST'], '/create', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $name =trim($this->request->getParam('name'));
    $children_name=trim($this->request->getParam('children_name'));



    $dep = \ORM::for_table('department')->create();
    $dep->create_time = Carbon::now()->toDateTimeString();

    $dep->name = $name;

    $dep->children_name=$children_name;
    $dep->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);

});


/**
 * @api {post} /department/update 更新部门
 * @apiDescription 更新部门
 * @apiName updateDepartment
 * @apiGroup Department
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.

 * @apiParam {Int} id 记录id.
 
 * @apiParam {String} name 部门名称.
 * @apiParam {String} children_name 子部门名称，以英文逗号分隔.

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
 * @apiSampleRequest /v1/department/update
 */
$app->map(['POST'], '/update', function ($request, $response, $args) {



    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $id = $this->request->getParam('id');
    $name =trim( $this->request->getParam('name'));
     $children_name=trim($this->request->getParam('children_name'));

    $dep = \ORM::for_table('department')->find_one($id);
    if($dep){
        $dep->name = $name;

        $dep->children_name=$children_name;
        $dep->save();
        $res['err_code'] = 0;
        $res['err_msg'] = "保存成功";
    }else{
        $res['err_code'] = 1;
        $res['err_msg'] = "记录不存在";
    }

    echo json_encode($res);

});



/**
 * @api {post} /department/delete 删除部门
 * @apiDescription 删除部门
 * @apiName deleteDepartment
 * @apiGroup Department
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
 * @apiSampleRequest /v1/department/delete
 */
$app->map(['POST','DELETE'], '/delete', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $user_id = $data->id;
    $id = $this->request->getParam('id');


    $dep = \ORM::for_table('department')->find_one($id);

    if($dep){
        $dep->delete();
        $res['err_code'] = 0;
        $res['err_msg'] = "删除成功";
    }else{
        $res['err_code'] = 1;
        $res['err_msg'] = "删除失败，记录不存在";
    }


    echo json_encode($res);

});


/**
 * @api {post} /department/find 获取单个部门信息
 * @apiDescription 根据id获取单部门信息
 * @apiName findOneDepartment
 * @apiGroup Department
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
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
 * @apiSampleRequest /v1/department/find
 */
$app->map(['GET','POST'], '/find', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $meid = $data->id;
    $id = $this->request->getParam('id');

    $dep = \ORM::for_table('department')->find_one($id);
    if($dep){
        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data']=$dep->as_array();
        echo json_encode($res);
    }else{
        $res['err_code'] = 1;
        $res['err_msg'] = "部门不在存或已删除";

        echo json_encode($res);
    }




});


/**
 * @api {post} /department/search 部门列表
 * @apiDescription 部门列表
 * @apiName listDepartment
 * @apiGroup Department
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.



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
 * @apiSampleRequest /v1/department/search
 */
$app->map(['GET','POST'], '/search', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
//
    $meid = $data->id;

    $dep = \ORM::for_table('department');

    $data=$dep
        ->order_by_asc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data']=$data;
    echo json_encode($res);

});