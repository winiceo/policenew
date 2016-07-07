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
 * @api {get} /check/get_users 下拉菜单获取用户
 * @apiDescription 获取待考核的下属用户名单
 * @apiName getUsers
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/check/get_users
 */
$app->map(['GET'], '/get_users', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $me = $data->id;

    $my = getUserInfo($me);
    $data = array();

    if ($my['level'] == 3) {
        $sql = sprintf("select id,username,job, real_name from users where department_id=%s and id!=%s ", $my['department_id'],$me);
        $data = \ORM::for_table("users")->raw_query($sql)->find_array();
    } elseif ($my['level'] == 2) {
        $deps = str_replace(";", ",", $my['department_id']);
        $sql = sprintf("select id,username,job, real_name from users where department_id in (%s) and level=3  and id!=%s", $deps,$me);
        $data = \ORM::for_table("users")->raw_query($sql)->find_array();
    } elseif ($my['level'] == 6 || $my['level'] == 7) {

        $sql = "select id,username,job, real_name from users where level!=1 and level!=2 and id!= ".$me;
        $data = \ORM::for_table("users")->raw_query($sql)->find_array();
    }
    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $data;
    echo json_encode($res);

});

/**
 * @api {post} /check/create 添加考核
 * @apiDescription 添加考核内容
 * @apiName createCheck
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {String} year 考核年份.
 * @apiParam {String} quarter 考核季度.
 * @apiParam {String} level 考核结果等级.
 * @apiParam {String} score 考核结果得分.
 * @apiParam {String} data 考核项得分明细.
 * @apiParam {Int} user_id 被考核用户id.

 * @apiParam {String} year_score 年度总得分（第四季度有效）.
 * @apiParam {String} year_level 年度总级别（第四季度有效）.
 * @apiSampleRequest /v1/check/create
 */

$app->map(['POST'], '/create', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $me = $data->id;

    $year = $this->request->getParam('year');
    $quarter = $this->request->getParam('quarter');
    $level = $this->request->getParam('level');
    $data = $this->request->getParam('data');
    $score = $this->request->getParam('score');
    $user_id = $this->request->getParam('user_id');
    $year_score = $this->request->getParam('year_score');
    $year_level = $this->request->getParam('year_level');
    $user = getUserInfo($user_id);
    $obj = \ORM::for_table('users_check')->create();
    $obj->create_time = Carbon::now()->toDateTimeString();
    $obj->user_id = $user_id;
    $obj->department_id = $user['department_id'];
    $obj->type = 1;
    $obj->year = $year;
    $obj->quarter = $quarter;
    $obj->data = $data;
    $obj->level = $level;
    $obj->score = $score;
    $obj->year_level = $year_level;
    $obj->year_score = $year_score;
    $obj->status="1000";

    $obj->actor_id = $me;

//    $obj->flow=json_encode(getCheckFlow($user_id)["data"]);
//    $obj->check_user_id=getCheckFlow($user_id)["check_user_id"];


    $obj->save();
//    $users=explode(";",$obj->check_user_id);
//    $tmp=array();
//    $tmp['id']=$obj->id;
//    $tmp['user_id']=$user_id;
//    $tmp['create_time']=$obj->create_time;
//
//
//    foreach($users as $k=>$v){
//        notice($v,3,$tmp);
//    }
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    echo json_encode($res);




});
//获取考核流程
function getCheckFlow($user){

    $data=\ORM::for_table('users')->select_many('id','real_name','job','department_id')->find_array();
    $tmp=array();
    $flow=array();
    $check_user_id=array();
    foreach($data as $k=>$v){
        $v['status']=1;
        $v['check_time']="";
        $tmp[$v['level']][]= $v;

    }

    if($user['level']==5||$user['level']==4){
        foreach($tmp[3] as $k=>$v){

            if(in_array($user['department_id'],explode(";", $v['department_id']))){
                $flow["one"][]=$v;
                $check_user_id[]=$v['id'];
            };
        }
    }elseif($user['level']==3){
        foreach($tmp[2] as $k=>$v){
            if(in_array($user['department_id'],explode(";", $v['department_id']))){
                $flow["one"][]=$v;
                $check_user_id[]=$v['id'];
            };
        }
    }



    foreach($tmp[6] as $k=>$v){
        $flow["two"][]=$v;
        if(count($check_user_id)==0){
            $check_user_id[]=$v['id'];
        }

    }
    foreach($tmp[7] as $k=>$v){
        $flow["three"][]=$v;
        if(count($check_user_id)==0){
            $check_user_id[]=$v['id'];
        }

    }

    return array("data"=>$flow,"check_user_id"=>implode(';',$check_user_id));


}

//获取下一步审核的人的列表
function getCheckUserByJob($user_id)
{
    $user = getUserInfo($user_id);
    if (!$user) {
        return null;
    }
    $temp = array();
    if ($user['level'] == 3) {

        $sql = "select id,username,job, real_name,department_id from users where  level=2 ";
        $data = \ORM::for_table("users")->raw_query($sql)->find_array();
        foreach ($data as $k => $v) {
            if (in_array($user['department_id'], explode(";", $v['department_id']))) {
                $temp[] = $v;

            }
        }
    } elseif ($user['level'] == 2) {
        $sql = "select id,username,job, real_name,department_id from users where  level=6 ";
        $data = \ORM::for_table("users")->raw_query($sql)->find_array();
        foreach ($data as $k => $v) {
            if (in_array($user['department_id'], explode(";", $v['department_id']))) {
                $temp[] = $v;

            }
        }
    }
    return $temp;
}

/**
 * @api {post} /check/update 更新考核内容
 * @apiDescription 更新考核内容
 * @apiName updateCheck
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {String} year 考核年份.
 * @apiParam {String} quarter 考核季度.
 * @apiParam {String} level 考核结果等级.
 * @apiParam {String} score 考核结果得分.
 * @apiParam {String} data 考核项得分明细.
 * @apiParam {Int} user_id 被考核用户id.
 *  @apiParam {String} year_score 年度总得分（第四季度有效）.
 * @apiParam {String} year_level 年度总级别（第四季度有效）.
 * @apiParam {String} action 动作['update','plus','reduce','finish']
 * @apiSampleRequest /v1/check/update
 */
$app->map(['POST'], '/update', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);

    $id = $this->request->getParam('id');

    $level = $this->request->getParam('level');
    $data = $this->request->getParam('data');
    $score = $this->request->getParam('score');
    $year_score = $this->request->getParam('year_score');
    $year_level = $this->request->getParam('year_level');
    $action = $this->request->getParam('action');
    $obj = \ORM::for_table('users_check')->find_one($id);
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    if($obj){
        $obj->data = $data;
        $obj->level = $level;
        $obj->score = $score;
        $obj->year_level = $year_level;
        $obj->year_score = $year_score;
        switch ($action) {
            case "plus":


                if($my->level==6){
                    if($obj->status==1000||$obj->status===1010||$obj->status==1011){
                        $obj->status= binplus($obj->status,'100');
                    }

                    $obj->save();
                }else{
                    $res['err_code'] = 1;
                    $res['err_msg'] = "无权限进行此操作";
                }

                break;
            case "reduce":
                if($my->level==7){
                    $res["obj"]=$obj->as_array();
                    if($obj->status==1000||$obj->status==1100||$obj->status==1101){
                        $obj->status= binplus($obj->status,'10');
                    }
                    $res['data']=\ORM::get_last_query();
                    $obj->save();
                }else{
                    $res['err_code'] = 1;
                    $res['err_msg'] = "无权限进行此操作";
                }

                break;
            case "finish":
                if($obj->status=="1110"&&$my->level==6){

                    $obj->status= binplus($obj->status,'1');
                    $obj->save();
                }else{
                    $res['err_code'] = 1;
                    $res['err_msg'] = "无权操作或考核没有进行完";
                }
                break;
            case "update":


                if(($my->id)==($obj->actor_id)){
                    $obj->save();

                }
                break;
          }



    }else{
        $res['err_code'] = 1;
        $res['err_msg'] = "操作失败，记录不存在";
    }

    echo json_encode($res);


});


/**
 * @api {post} /check/public 考核公示，批量操作
 * @apiDescription 考核公示
 * @apiName publicCheck
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Array} ids id数组.

 * @apiSampleRequest /v1/check/public
 */
$app->map(['POST'], '/public', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);

    $ids = $this->request->getParam('ids');
    $res['err_code'] = 1;
    $res['err_msg'] = "保存失败";
    if($ids){
        $ids=json_decode($ids);
        $objs = \ORM::for_table('users_check')->where_in("id",$ids)->find_many();
        if($objs){
            foreach($objs as $k=>$obj){
                if($obj->status=="1110"&&$my->level==6){
                    $obj->status= binplus($obj->status,'1');
                    $obj->save();
                    $res['err_code'] = 0;
                    $res['test'] = \ORM::get_last_query();;
                    $res['err_msg'] = "操作成功";
                }else{
                    $res['err_code'] = 1;
                    $res['test'] = \ORM::get_last_query();;
                    $res['err_msg'] = "无权操作或考核没有进行完";
                }
            }
        }

    }
    echo json_encode($res);


});

/**
 * @api {post} /check/search 查询考核列表
 * @apiDescription 查询考核列表
 * @apiName listCheck
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} page 分页 为空则为1
 * @apiParam {Int} department_id 部门id,若为null,则返回全部用户的记录.
 * @apiParam {String} year 查询年份.
 * @apiParam {String} quarter 查询季度  .
 * @apiParam {Int} actor_id 创建者id  .
 * @apiParam {String} action 查询类型0为非公示，1未考核，2已考核，3已完成 5为公示 .
 * @apiParam {Int} status 审核状态，1000：部门领导完成，2：1100(1110) 政治处考核完，3:1010（1110)纪委督查考核完成，5：1111考核公示
 * @apiSampleRequest /v1/check/search
 */
$app->map(['GET', 'POST'], '/search', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $page = $this->request->getParam('page');
    if (!$page) {
        $page = 1;
    }

    $pageSize = 10;

    $department_id = $this->request->getParam('department_id');

    $status = $this->request->getParam('status');
    $year = $this->request->getParam('year');
    $quarter = $this->request->getParam('quarter');
    $actor_id = $this->request->getParam('actor_id');
    $action=$this->request->getParam('action');
    $obj = \ORM::for_table('users_check');
    if($action){
        switch($action){
            case "0":
                 $obj->where_raw(sprintf("`status`!='%s'", '1111'));
                break;
            case "1":
                if($my->level==6){
                    $obj->where_raw("`status` in ('1000','1010')");
                }elseif($my->level==7){
                    $obj->where_raw("`status` in ('1100','1000')");
                }

                break;
            case "2":
                if($my->level==6){
                    $obj->where_raw("`status` in ('1100','1110')");
                }elseif($my->level==7){
                    $obj->where_raw("`status` in ('1110','1010')");
                }

                break;
            case "3":
                    $obj->where_raw("`status` ='1110' ");
                break;
            case "5":
                $obj->where_raw("`status` ='1111' ");
                break;
        }
    }
    if ($actor_id>0) {
        $obj->where_raw(sprintf("`actor_id`='%s'", $actor_id));

    }
    if ($department_id>0) {
        $obj->where_raw(sprintf("`department_id`='%s'", $department_id));

    }

    if ($year) {
        $obj->where_raw(sprintf("`year`='%s'", $year));
    }
    if ($quarter) {
        $obj->where_raw(sprintf("`quarter`='%s'", $quarter));
    }

    $count = rand(1, @ceil($obj->count() / $pageSize));

    $data = $obj->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);

});



/**
 * @api {post} /check/my  我的绩效考核
 * @apiDescription 查询我的考核列表
 * @apiName myCheck
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} page 分页 为空则为1
  * @apiSampleRequest /v1/check/my
 */
$app->map(['GET', 'POST'], '/my', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);


    $page = $this->request->getParam('page');
    if (!$page) {
        $page = 1;
    }

    $pageSize = 50;



    $obj = \ORM::for_table('users_check');


    $obj->where_raw(sprintf("`user_id`='%s'",$my->id));


    $count = rand(1, @ceil($obj->count() / $pageSize));

    $data = $obj->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);

});


/**
 * @api {post} /check/find_one  绩效考核获取
 * @apiDescription 绩效考核获取
 * @apiName findOne
 * @apiGroup Check
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} year 年份
 * @apiParam {Int} quarter 季度
 * @apiParam {Int} user_id 用户id
 * @apiSampleRequest /v1/check/my
 */
$app->map(['GET', 'POST'], '/find_one', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $meid = $data->id;
    $year = $this->request->getParam('year');
    $quarter = $this->request->getParam('quarter');
    $user_id = $this->request->getParam('user_id');
    $obj = \ORM::for_table('users_check');

    $obj->where_raw(sprintf("`user_id`='%s'",$user_id));
    $obj->where_raw(sprintf("`year`='%s'",$year));
    if($quarter){
        $obj->where_raw(sprintf("`quarter`='%s'",$quarter));
    }
    $data = $obj->find_array() ;

    $res['err_code'] = 0;
    $res['err_msg'] = \ORM::get_last_query();
    if($data){
        $res['data'] =$data;
    }else{
        $res['data'] =array();
    }

    echo json_encode($res);

});




