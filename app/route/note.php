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
 * @api {post} /note/create 添加个人日志
 * @apiDescription 添加个人日志
 * @apiName createDep
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Datetime} add_time 日期.
 * @apiParam {String} content 内容.
 * @apiParam {String} attach 附件.
 * @apiParam {String} over_work 加班说明.
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
 * @apiSampleRequest /v1/note/create
 */

$app->map(['POST'], '/create', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    if (!$my->department_id) {
        $u = getUserInfo($my->id);
        $my->department_id = $u->department_id;
    }

    $add_time = trim($this->request->getParam('add_time'));
    $content = trim($this->request->getParam('content'));
    $attach = trim($this->request->getParam('attach'));
    $over_work = trim($this->request->getParam('over_work'));


    $plan = \ORM::for_table('users_notes')->create();
    $plan->add_time = $add_time;
    $plan->create_time = \Carbon\Carbon::now()->toDateTimeString();
    $plan->user_id = $my->id;
    $plan->department_id = $my->department_id;
    $plan->level = $my->level;
    $plan->content = $content;
    $plan->attach = $attach;
    $plan->over_work = $over_work;
    $plan->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);

});


/**
 * @api {post} /note/update 更新个人日志
 * @apiDescription 更新个人日志
 * @apiName updateNote
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {Datetime} add_time 日期.
 * @apiParam {String} content 内容.
 * @apiParam {String} attach 附件.
 * @apiParam {String} over_work 加班说明.
 * @apiSampleRequest /v1/note/update
 */
$app->map(['POST'], '/update', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $id = $this->request->getParam('id');

    $add_time = trim($this->request->getParam('create_time'));
    $content = trim($this->request->getParam('content'));
    $attach = trim($this->request->getParam('attach'));
    $over_work = trim($this->request->getParam('over_work'));


    $plan = \ORM::for_table('users_notes')->find_one($id);
    if ($plan) {
        $plan->user_id = $user_id;
        $plan->add_time = $add_time;
        $plan->content = $content;
        $plan->attach = $attach;
        $plan->over_work = $over_work;

        $plan->save();
        $res['err_code'] = 0;
        $res['err_msg'] = "保存成功";
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "记录不存在";
    }

    echo json_encode($res);

});


/**
 * @api {post} /note/delete 删除个人日志
 * @apiDescription 删除个人日志
 * @apiName deleteNote
 * @apiGroup Note
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
 * @apiSampleRequest /v1/note/delete
 */
$app->map(['POST', 'DELETE'], '/delete', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $user_id = $data->id;
    $id = $this->request->getParam('id');


    $plan = \ORM::for_table('users_notes')->where_equal("user_id", $user_id)->find_one($id);

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
 * @api {post} /note/search 个人日志列表
 * @apiDescription 个人日志列表
 * @apiName searchNote
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Datetime} star_time 时间段：开始日期.
 * @apiParam {Datetime} end_time 时间段：结束日期.
 * @apiSampleRequest /v1/note/search
 */
$app->map(['GET', 'POST'], '/search', function ($request, $response, $args) {


    $res = array();
    $my = check($this->request);


    $page = $this->request->getParam('page');
    if (!$page) {
        $page = 1;
    }
    $pageSize = 10;
    $user_id = $this->request->getParam('user_id');
    $star = $this->request->getParam('star_time');
    $end = $this->request->getParam('end_time');

    $plan = \ORM::for_table('users_notes');
    $plan->where_raw(sprintf("`user_id`='%s'", $my->id));



    if ($star) {
        $plan->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')>='" . $star . "'");
    }
    if ($end) {
        $plan->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')<='" . $end . "'");
    }
    $count = rand(1, @ceil($plan->count() / $pageSize));

    $data = $plan->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();
    if($data){
        foreach($data as $k=>$v){
            $data[$k]["comment"]=getComments($v["id"]);
        }
    }
    $res['err_code'] = 0;
    $res['err_msg'] = \ORM::get_last_query();
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);


});


/**
 * @api {post} /note/add_comment 日志评论
 * @apiDescription 日志评论
 * @apiName addComment
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 工作日志id .
 * @apiParam {String} comment 内容.
 * @apiSampleRequest /v1/note/add_comment
 */
$app->map(['POST'], '/add_comment', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $user=getUserInfo($my->id);

    $note_id = $this->request->getParam('id');
    $comment = trim($this->request->getParam('comment'));

    $obj = \ORM::for_table('note_comment')->create();
    $obj->note_id = $note_id;

    $obj->user_id = $my->id;
    $obj->user_name = $user['real_name'];
    $obj->content = $comment;
    $obj->create_time = \Carbon\Carbon::now()->toDateTimeString();

    $obj->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "添加评论成功";


    echo json_encode($res);

});

/**
 * @api {post} /note/list 查看下属工作日志
 * @apiDescription 级别为3只能查看自己部门，级别小于3则可以查看所有，级别大于3只能查看自己
 * @apiName listNote
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Datetime} star_time 时间段：开始日期.
 * @apiParam {Int} department_id 级别小于3，部门id有效.
 * @apiParam {Int} user_id  级虽<=3,用户id有效，级别=3，只能查看此部门用户.
 * @apiParam {Datetime} end_time 时间段：结束日期.
 * @apiSampleRequest /v1/note/list
 */
$app->map(['GET', 'POST'], '/list', function ($request, $response, $args) {


    $res = array();
    $my = check($this->request);


    $page = $this->request->getParam('page');

    if (!$page) {
        $page = 1;
    }
    $pageSize = 10;

    $star = $this->request->getParam('star_time');
    $end = $this->request->getParam('end_time');
      $user_id = 0;
    $department_id = 0;
    $user_id = $this->request->getParam('user_id');
    if ($my->level == 3) {
        $department_id = $my->department_id;

    } elseif ($my->level > 3) {

        $user_id = $my->id;
    } elseif ($my->level < 3) {
        $department_id = $this->request->getParam('department_id');
    }

    $plan = \ORM::for_table('users_notes');
    if ($user_id > 0) {
        $plan->where_raw(sprintf("`user_id`='%s'", $user_id));

    };
    if ($department_id > 0) {
        $plan->where_raw(sprintf("`department_id`='%s'", $department_id));
    };

    if ($star) {
        $plan->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')>='" . $star . "'");
    }
    if ($end) {
        $plan->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')<='" . $end . "'");
    }
    $count = rand(1, @ceil($plan->count() / $pageSize));

    $data = $plan->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();
    if($data){
        foreach($data as $k=>$v){
            $data[$k]["comment"]=getComments($v["id"]);
        }
    }

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);


});




/**
 * @api {post} /note/status 更新公示状态
 * @apiDescription  修改公示状态 public_flag  1,公示，0未公示 有权操作
 * @apiName changeStatus
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 任务id.
 * @apiParam {Int} public_flag 状态，1，公示，0，未公示

 * @apiSampleRequest /v1/note/status
 */

$app->map(['GET',"POST"], '/status', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $id = $this->request->getParam('id');
    $public_flag=$this->request->getParam('public_flag');
    $remark = $this->request->getParam('remark');
    $task = \ORM::for_table('users_notes')->find_one($id);
    $res['err_code'] = 1;
    $res['err_msg'] = "无权操作";
    if($task){

        if($my->level==3&&$my->department_id==$task->department_id){
            $task->public_flag = $public_flag;

            $task->save();
            $res['err_code'] = 0;
            $res['err_msg'] = "保存成功";
        }

        if($my->level==2||$my->level==1||$my->level==6){
            $task->public_flag =  $public_flag;

            $task->save();
            $res['err_code'] = 0;
            $res['err_msg'] = "保存成功";
        }
    }else{
        $res['err_msg']="记录不存在";
    }
    $res['data'] = $task;
    echo json_encode($res);

});

/**
 * @api {post} /note/public_note 公示列表
  * @apiName publicNote
 * @apiGroup Note
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Datetime} star_time 时间段：开始日期.
  * @apiParam {Datetime} end_time 时间段：结束日期.
 * @apiSampleRequest /v1/note/public_note;
 */
$app->map(['GET', 'POST'], '/public_note', function ($request, $response, $args) {


    $res = array();
    $my = check($this->request);


    $page = $this->request->getParam('page');

    if (!$page) {
        $page = 1;
    }
    $pageSize = 10;

    $star = $this->request->getParam('star_time');
    $end = $this->request->getParam('end_time');


    $plan = \ORM::for_table('users_notes');


    if ($star) {
        $plan->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')>='" . $star . "'");
    }
    if ($end) {
        $plan->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')<='" . $end . "'");
    }
    $plan->where_equal("public_flag",1);
    $count = rand(1, @ceil($plan->count() / $pageSize));

    $data = $plan->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();
    if($data){
        foreach($data as $k=>$v){
            $data[$k]["comment"]=getComments($v["id"]);
        }
    }

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);


});


function getComments($id){

    $data=\Orm::for_table("note_comment")->where_equal("note_id",$id)->order_by_desc("create_time")->find_array();
    if($data){
        return $data;
    }else{
        return array();
    }

}
