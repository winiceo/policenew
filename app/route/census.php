<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/7/7
 * Time: 下午7:58
 */
/**
 * @apiDefine member User access only
 * 任务管理
 */

include_once ROOT . '/app/lib/pmkoo.php';
include_once ROOT . '/app/route/func.php';

use Carbon\Carbon;



//获取用户信息
function getUserDetail($id)
{
    $user = \ORM::for_table('users')->find_one($id);
    if ($user) {
        $ids=explode(",",$user->department_id);
        $department = \ORM::for_table('department')->where_in("id", $ids)->find_many();

        $user->department_name = $department[0]['name'];

        $obj = \ORM::for_table('users_power');
        $rs = $obj->where("user_id", $id)->find_array();
        $tmp = array();
        if ($rs) {
            foreach ($rs as $k => $v) {
                $tmp[] = $v["power_level"];
            }
        };
        $user->power=$tmp;

        return $user;
    } else {
        return false;
    }
}

/**
 * @api {post} /census/create 创建户籍审核记录
 * @apiDescription type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiName createCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} status 状态，默认为1，待审核，2为已完成,
 * @apiParam {String} type 类型,type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiParam {String} json,存储表格数据,提交json字符串
 * @apiParam {Datetime} add_time 创建日期.系统默认
 * @apiSampleRequest /v1/census/create
 */

$app->map(['POST'], '/create', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);

    $type = $this->request->getParam('type');
    $content = $this->request->getParam('json');


    $task = \ORM::for_table('census')->create();
    $task->add_time = Carbon::now()->toDateTimeString();
    $task->user_id = $my->id;
    $task->department_id = $my->department_id;
    $task->type = $type;
    $task->step = 1;

    $task->status = 1;
    $task->json = $content;
    $task->flow = json_encode(getCensusFlow($my->id, $type)["data"]);
    $task->check_user_id = getCensusFlow($my->id, $type)["check_user_id"];

    $task->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    $res['data'] = $task->as_array();
    echo json_encode($res);

});

$app->map(['GET'], '/create', function ($request, $response, $args) {

    $res = array();
    $res=getCensusFlow(28, 1) ;

    dump($res);
});

/**
 * @api {post} /census/update 更新户籍审核记录
 * @apiDescription type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiName updateCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {Int} status 状态，默认为1，待审核，2为已完成,
 * @apiParam {String} type 类型,type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiParam {String} json,存储表格数据,提交json字符串
 * @apiParam {Datetime} add_time 创建日期.系统默认
 * @apiSampleRequest /v1/census/update
 */


$app->map(['POST'], '/update', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $id = $this->request->getParam('id');

    $type = $this->request->getParam('type');
    $content = $this->request->getParam('json');
    $status = $this->request->getParam('status');

    $task = \ORM::for_table('census')->find_one($id);
    $task->add_time = Carbon::now()->toDateTimeString();
    //$task->user_id = $my->id;
    $task->type = $type;
    // $task->status=$status;
    $task->json = $content;
    $task->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    $res['data'] = $task->as_array();
    echo json_encode($res);


});


/**
 * @api {post} /census/delete 删除记录
 * @apiDescription
 * @apiName deleteCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiSampleRequest /v1/census/delete
 */
$app->map(['POST', 'DELETE'], '/delete', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $id = $this->request->getParam('id');
    $task = \ORM::for_table('census')->find_one($id);
    if ($task) {
        $task->delete();
        $res['err_code'] = 0;
        $res['err_msg'] = "删除成功";
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "删除失败，记录不存在";
    }
    echo json_encode($res);

});

/**
 * @api {get} /census/getone 获取单条记录
 * @apiDescription
 * @apiName GetoneCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiSampleRequest /v1/census/getone
 */
$app->map(['POST', 'GET'], '/getone', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $user_id = $data->id;
    $id = $this->request->getParam('id');
    $task = \ORM::for_table('census')->find_one($id);
    if ($task) {

        $res['err_code'] = 0;
        $res['data'] = $task->as_array();
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "记录不存在";
    }
    echo json_encode($res);

});
/**
 * @api {post} /census/change_status 更新状态
 * @apiDescription
 * @apiName statusCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {Int} status 记录状态 1为未审核,2为审核通过.
 * @apiSampleRequest /v1/census/delete
 */
$app->map(['POST', 'DELETE'], '/change_status', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);
    $id = $this->request->getParam('id');
    $status = $this->request->getParam('status');
    $task = \ORM::for_table('census')->find_one($id);
    if ($task) {
        $task->status = $status;
        $task->save();
        $res['err_code'] = 0;
        $res['err_msg'] = "更新状态成功";
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "更新状态失败，记录不存在";
    }
    echo json_encode($res);

});
/**
 * @api {post} /census/search 查询户籍
 * @apiDescription type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiName listCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {String} type 按类型查询.
 * @apiParam {String} star_time 时间段：开始日期.
 * @apiParam {String} end_time 时间段：结束日期.
 * @apiParam {String} status 状态：1待审核,2为审核通过.
 * @apiSampleRequest /v1/census/search
 */
$app->map(['GET', 'POST'], '/search', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $page = $this->request->getParam('page');
    if (!$page) {
        $page = 1;
    }

    $pageSize = 10;

    $type = $this->request->getParam('type');

    $star = $this->request->getParam('star_time');
    $end = $this->request->getParam('end_time');
    $status = $this->request->getParam('status');
    $task = \ORM::for_table('census');


    if ($star) {
        $task->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')>='" . $star . "'");
    }
    if ($end) {
        $task->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')<='" . $end . "'");
    }


    if ($type) {
        $task->where_raw(sprintf("`type`='%s'", $type));
    }
    if ($status) {
        $task->where_raw(sprintf("`status`='%s'", $status));
    }

    $user = getUserDetail($my->id);



    if(in_array(2,$user->power)){
        $task->where_raw(sprintf("`department_id`='%s'", $my->department_id));
    }elseif(in_array(3,$user->power)||in_array(4,$user->power)){

    }elseif(in_array(1,$user->power)){
        $task->where_raw(sprintf("`user_id`='%s'", $my->id));
    } else {
        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['test'] = \ORM::get_last_query();
        $res['data'] = array('list' => array(), 'total' => 0);
        echo json_encode($res);
        exit;
    }


    $count = rand(1, @ceil($task->count() / $pageSize));

    $data = $task->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = $user;
    $res['test'] = \ORM::get_last_query();
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);

});

/**
 * @api {post} /census/check_in 审核通过
 * @apiDescription 审核通过
 * @apiName check_in
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {String} reason 操作理由.
 * @apiSampleRequest /v1/census/check_in
 */

$app->map(['POST', "GET"], '/check_in', function ($request, $response, $args) {
    $res = array();
    $my = check($this->request);
    $id = $this->request->getParam('id');
    $reason = $this->request->getParam('reason');

    $plan = \ORM::for_table('census')->where('status', 1)->where('flag', 1)->find_one($id);

    $my = getUserDetail($my->id);

    $res = census_check_in($my, $id, $reason);

    echo json_encode($res);

});
//审核通过
function census_check_in($user, $id, $reason)
{
    $me = $user->id;
    //$level = $user->level;

    $plan = \ORM::for_table('census')->where('status', 1)->find_one($id);

    $flow_data = array(1=>"one" , 2=>"two"  ,3=> "three");
    $step=$plan->step;
    if ($plan) {
       // dump($me);
       // dump($plan->check_user_id);
        if (in_array($me, explode(";", $plan->check_user_id))) {

            //echo 333;
            $flow = json_decode($plan->flow, true);
            $flag=0;
             foreach ($flow as $k => $v) {

                if (count($v) > 1) {

                    foreach ($v as $m => $n) {

                        if ($n['id'] == $me && $n['status'] == 1) {
                            $flow[$k][$m]['check_time'] = Carbon::now()->toDateTimeString();
                            $flow[$k][$m]['status'] = 2;
                            $flow[$k][$m]['reason'] = $reason;
                            $plan->step=$step+1;
                            $flag=1;
                            break;

                        }
                    }
                } else {
                    $v = $v[0];
                    if ($v['id'] == $me && $v['status'] == 1) {

                        $v['check_time'] = Carbon::now()->toDateTimeString();;
                        $v['status'] = 2;
                        $v['reason'] = $reason;
                        $flow[$k][0] = $v;
                        $plan->step=$step+1;
                        $flag=1;

                        break;

                    }
                }
                 if($flag==1){
                     break;
                 }
            }

            $next=$flow[$flow_data[$plan->step]];


            $check_user_id = array();
            if (is_array($next)) {
                foreach ($next as $k => $v) {
                    $check_user_id[] = $v["id"];
                }
            } else {
                $check_user_id[] = $next["id"];
            }

            $plan->check_user_id = implode(';', $check_user_id);

            if ($plan->type == 1) {

                //代局长签完流程结束
                if ($plan->flag == 1 && in_array(4,$user->power)) {
                    $plan->status = 2;
                    $plan->check_user_id = 0;
                }

                if ( $step==2&& in_array(3,$user->power)) {
                    $plan->flag = 1;

                }

            } elseif ($plan->type == 2) {

                if ($step==3&&in_array(4,$user->power)) {
                    $plan->status = 2;
                    $plan->check_user_id = 0;

                }
            } elseif ($plan->type == 3) {

                if ($step==2&&in_array(3,$user->power)) {
                    $plan->status = 2;
                    $plan->check_user_id = 0;
                }
            }

            // dump($flow);
            $plan->flow = json_encode($flow, true);


            $plan->save();
            $res['err_code'] = 0;
            $res['err_msg'] = "已审核通过";

        } else {
            $res['err_code'] = 1;
            $res['err_msg'] = "操作失败";
        };


    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "操作失败";
    }


    return ($res);
}

/**
 * @api {post} /census/check_out 审核未通过
 * @apiDescription 审核未通过
 * @apiName check_out
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiSampleRequest /v1/census/check_out
 */

$app->map(['GET', 'POST'], '/check_out', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $me = $data->id;
    $level = $data->level;


    $id = $this->request->getParam('id');
    $reason = $this->request->getParam('reason');
    $plan = \ORM::for_table('census')->where('status', 1)->find_one($id);
    ///echo ORM::get_last_query();
    $flow_data = array("one" => 1, "two" => 2, "three" => 3);
    //dump($plan);
    if ($plan) {

        if (in_array($me, explode(";", $plan->check_user_id))) {


            $flow = json_decode($plan->flow, true);


            $flow_current = "one";
            foreach ($flow as $k => $v) {

                if (count($v) > 1) {

                    foreach ($v as $m => $n) {

                        if ($n['id'] == $me) {
                            $flow[$k][$m]['check_time'] = Carbon::now()->toDateTimeString();
                            $flow[$k][$m]['status'] = 3;
                            $flow[$k][$m]['reason'] = $reason;
                            $flow_current = $k;
                        }
                    }
                } else {
                    $v = $v[0];

                    if ($v['id'] == $me) {

                        $v['check_time'] = Carbon::now()->toDateTimeString();;
                        $v['status'] = 3;
                        $v['reason'] = $reason;
                        $flow[$k][0] = $v;
                        $flow_current = $k;
                    }
                }
            }


            $plan->status = 3;
            $plan->check_user_id = 0;
            $plan->flow = json_encode($flow, true);
            $plan->save();
            $res['err_code'] = 0;
            $res['err_msg'] = "驳回成功";

        } else {
            $res['err_code'] = 1;
            $res['err_msg'] = "驳回失败";
        };


    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "操作失败";
    }
    echo json_encode($res);


});


//获取用户审核流程
function getCensusFlow($user_id, $type)
{
    $user = getUserInfo($user_id);


    $data = getFlowCensu($user, $type);

    return $data;


}

//权限级别,部门id
function getUserPower($level,$depart_id=0){
    $rs = \ORM::for_table('users_power')->where("power_level", $level)->find_array();
    $tmp=array();
    if($rs){
        if($depart_id>0){

            foreach($rs as $key=>$value){
                if(in_array($depart_id,explode(";",$value["dep_id"]))){
                    $tmp[]=getFlowUser($value["user_id"]);
                };
            }
        }elseif($depart_id==0){
            foreach($rs as $key=>$value){

                    $tmp[]=getFlowUser($value["user_id"]);

            }
        }
    }
    return $tmp;
}

function getFlowUser($user_id){

    $data = \ORM::for_table('users')->select_many('id', 'real_name', 'job', 'department_id')->find_one($user_id)->as_array();

    $data['level'] = getJob(trim($data['job']))["sign"];
    $data['status'] = 1;
    $data['check_time'] = "";
    $data['reason'] = "";
    return $data;
}

function getFlowCensu($user, $type){


    $flow = array();
    $check_user_id = array();



    $tmp=getUserPower(2,$user["department_id"]);

    foreach ($tmp as $k => $v) {
            $flow["one"][] = $v;
            $check_user_id[] = $v['id'];
    }


    $tmp=getUserPower(3);

    if ($type == 1) {

        foreach ($tmp as $k => $v) {

                $flow["two"][] = $v;
                $flow["three"][] = $v;
        }

    } elseif ($type == 2) {
        foreach ($tmp as $k => $v) {
             $flow["two"][] = $v;

        }
        $tmp=getUserPower(4);
        foreach ($tmp as $k => $v) {
           $flow["three"][] = $v;
        }

    }elseif ($type == 3) {

        foreach ($tmp as $k => $v) {

            $flow["two"][] = $v;
            //$flow["three"][] = $v;
        }
    }

    return array("data" => $flow, "check_user_id" => implode(';', $check_user_id));


}




/**
 * @api {get} /census/processing 获取需要处理的事项
 * @apiDescription 获取需要处理的事项
 * @apiName processing
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/census/processing
 */

$app->map(['POST', 'GET'], '/processing', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);

    $meid = $data->id;

    $plan = \ORM::for_table('census');
    $plan->where_raw(sprintf("`status`='%s'", 1));
    $data = $plan
        ->order_by_desc('id')->limit(100)->find_array();
    $tmp = array();
    foreach ($data as $k => $v) {
        if (in_array($meid, explode(";", $v['check_user_id']))) {
            $tmp[] = $v;
        };
    }

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $tmp;
    echo json_encode($res);
});


/**
 * @api {post} /census/mylist 我的审批表列表
 * @apiDescription 显示自己添加的审批列表
 * @apiName myList
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {String} type 按类型查询.
 * @apiParam {String} status 状态：1待审核,2为审核通过.
 * @apiSampleRequest /v1/census/mylist
 */
$app->map(['GET', 'POST'], '/mylist', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $page = $this->request->getParam('page');
    if (!$page) {
        $page = 1;
    }

    $pageSize = 10;

    $type = $this->request->getParam('type');

    $star = $this->request->getParam('star_time');
    $end = $this->request->getParam('end_time');
    $status = $this->request->getParam('status');
    $task = \ORM::for_table('census');


//    if ($star) {
//        $task->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')>='" . $star . "'");
//    }
//    if ($end) {
//        $task->where_raw("DATE_FORMAT(add_time,'%Y-%m-%d')<='" . $end . "'");
//    }
//
//
    if ($type) {
        $task->where_raw(sprintf("`type`='%s'", $type));
    }
    if ($status) {
        $task->where_raw(sprintf("`status`='%s'", $type));
    }

    $task->where_raw(sprintf("`user_id`='%s'", $my->id));

    $count = rand(1, @ceil($task->count() / $pageSize));

    $data = $task->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['test'] = \ORM::get_last_query();
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);

});

/**
 * @api {post} /census/recreate 驳回的审请重新提交
 * @apiDescription type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiName recreateCensus
 * @apiGroup Census
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {Int} status 状态，默认为1，待审核，2为已完成,
 * @apiParam {String} type 类型,type为1为姓名、性别变更更正和族别变更，2为出生年月和族别更正,3省外人口迁入农转城
 * @apiParam {String} json,存储表格数据,提交json字符串
 * @apiParam {Datetime} add_time 创建日期.系统默认
 * @apiSampleRequest /v1/census/recreate
 */


$app->map(['POST'], '/recreate', function ($request, $response, $args) {

    $res = array();
    $my = check($this->request);
    $id = $this->request->getParam('id');



    $task = \ORM::for_table('census')->find_one($id);
    if($my->id!=$task->user_id){
        $res['err_code'] = 1;
        $res['err_msg'] = "只有创建者才可以重现提交";

        echo json_encode($res);
        exit;
    }

    $type=$task->type;
    $task->add_time = Carbon::now()->toDateTimeString();

    $task->status = 1;
    $task->step = 1;
    $task->flag=0;
    $task->flow = json_encode(getCensusFlow($my->id, $type)["data"]);
    $task->check_user_id = getCensusFlow($my->id, $type)["check_user_id"];


    $task->save();
    $res['err_code'] = 0;
    $res['err_msg'] = "保存成功";
    $res['data'] = $task->as_array();
    echo json_encode($res);


});





$app->map(['GET', 'POST'], '/createtable', function ($request, $response, $args) {

    // createTask();
    //census_mylist();
    $query="
CREATE TABLE `users_power` (
  `user_id` int(10) unsigned NOT NULL,
  `power_level` int(4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_id` int(4) DEFAULT NULL,
  `dep_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

";
    $rs = \ORM::raw_execute($query);
    dump($rs);

    $query="
CREATE TABLE `census` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT NULL,
  `json` text COLLATE utf8_unicode_ci,
  `add_time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `user_id` int(10) DEFAULT NULL,
  `flow` text COLLATE utf8_unicode_ci,
  `check_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` tinyint(1) DEFAULT '0' COMMENT '可否代签，1为可代签，0为不可',
  `department_id` int(4) DEFAULT NULL,
  `step` int(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

";
    $rs = \ORM::raw_execute($query);
    dump($rs);
//
});