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

ini_set('memory_limit', '256M');
ini_set('post_max_size', '256M');

use Carbon\Carbon;

/**
 * @api {get} /helper/getjob 获取职位名称
 * @apiDescription 职位名称直接系统定义
 * @apiName getJobs
 * @apiGroup Helper
 * @apiSampleRequest /v1/helper/getjob
 * 5(4)->3->2-6-》1
 */

$app->map(['POST', 'GET'], '/getjob', function ($request, $response, $args) {
    $jobs = getJob();


    $res = array();
    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $jobs;
    echo json_encode($res);

});

/**
 * @api {get} /helper/getlevel 获取职位名称
 * @apiDescription 职位名称直接系统定义
 * @apiName getLevel
 * @apiGroup Helper
 * @apiSampleRequest /v1/helper/getlevel
 */

$app->map(['POST', 'GET'], '/getlevel', function ($request, $response, $args) {
    $jobs = array('局级', '副局级', '副科级', '副科级');
    $res = array();
    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $jobs;
    echo json_encode($res);

});

/**
 * @api {get} /helper/getrole 获取角色名称
 * @apiDescription 获取角色
 * @apiName getRole
 * @apiGroup Helper
 * @apiSampleRequest /v1/helper/getrole
 */

$app->map(['POST', 'GET'], '/getrole', function ($request, $response, $args) {
    $jobs = array();
    $jobs['admin'] = "超级管理员";

    $jobs['owener'] = "普通用户";
    $res = array();
    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = $jobs;
    echo json_encode($res);

});

/**
 * @api {get} /helper/processing 获取需要处理的事项
 * @apiDescription 获取需要处理的事项
 * @apiName processing
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/helper/processing
 */

$app->map(['POST', 'GET'], '/processing', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);

    $meid = $data->id;

    $plan = \ORM::for_table('users_event');
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
 * @api {post} /helper/check_in 审核通过
 * @apiDescription 审核通过
 * @apiName check_in
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiParam {String} reason 操作理由.
 * @apiSampleRequest /v1/helper/check_in
 */

$app->map(['POST', "GET"], '/check_in', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $me = $data->id;
    $level = $data->level;
    $id = $this->request->getParam('id');
    $reason = $this->request->getParam('reason');
    $plan = \ORM::for_table('users_event')->where('status', 1)->find_one($id);

    $flow_data = array("one" => 1, "two" => 2, "three" => 3, "four" => 4);
    if ($plan) {
        if (in_array($me, explode(";", $plan->check_user_id))) {
            $flow = json_decode($plan->flow, true);


            $flow_current = "one";
            foreach ($flow as $k => $v) {

                if (count($v) > 1) {

                    foreach ($v as $m => $n) {

                        if ($n['id'] == $me) {
                            $flow[$k][$m]['check_time'] = Carbon::now()->toDateTimeString();
                            $flow[$k][$m]['status'] = 2;
                            $flow[$k][$m]['reason'] = $reason;
                            $flow_current = $k;
                        }
                    }
                } else {
                    $v = $v[0];


                    if ($v['id'] == $me) {

                        $v['check_time'] = Carbon::now()->toDateTimeString();;
                        $v['status'] = 2;
                        $v['reason'] = $reason;
                        $flow[$k][0] = $v;
                        $flow_current = $k;
                    }
                }
            }

            if ($level == 1) {
                $plan->status = 2;
                $plan->check_user_id = 0;

            } else {
                $next = null;
                foreach ($flow_data as $k => $v) {
                    if ($v == ($flow_data[$flow_current] + 1)) {
                        $next = $flow[$k];
                    }
                }

                $check_user_id = array();
                if (is_array($next)) {
                    foreach ($next as $k => $v) {
                        $check_user_id[] = $v["id"];
                    }
                } else {
                    $check_user_id[] = $next["id"];
                }
                $plan->check_user_id = implode(';', $check_user_id);
            }

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


    echo json_encode($res);
});


/**
 * @api {post} /helper/check_out 审核未通过
 * @apiDescription 审核未通过
 * @apiName check_out
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} id 记录id.
 * @apiSampleRequest /v1/helper/check_out
 */

$app->map(['GET', 'POST'], '/check_out', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $me = $data->id;
    $level = $data->level;


    $id = $this->request->getParam('id');
    $reason = $this->request->getParam('reason');
    $plan = \ORM::for_table('users_event')->where('status', 1)->find_one($id);

    $flow_data = array("one" => 1, "two" => 2, "three" => 3, "four" => 4);
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


/**
 * @api {post} /helper/setting 系统配置信息更新
 * @apiDescription key: sign_in_time签到时间;sign_out_time签退时间
 * @apiName setting
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {String} key 配置项key.
 * @apiParam {String} value 配置项value.
 * @apiSampleRequest /v1/helper/setting
 */

$app->map(['POST'], '/setting', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $meid = $data->id;
    $key = $this->request->getParams();

    foreach ($key as $k => $v) {
        $plan = \ORM::for_table('settings')->select_many('key', 'value', 'id')->where('key', $k)->find_one();

        if ($plan && $v) {
            $plan->value = trim($v);
            $plan->save();

        }
    }
    $res['err_code'] = 0;
    $res['err_msg'] = "更新成功";
    echo json_encode($res);


});


/**
 * @api {get} /helper/setting 系统配置信息获取
 * @apiDescription key: sign_in_time签到时间;sign_out_time签退时间
 * @apiName getsetting
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/helper/setting
 */

$app->map(['GET'], '/setting', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $meid = $data->id;


    $value = trim($this->request->getParam('value'));

    $plan = \ORM::for_table('settings')->select_many('key', 'value')->find_array();

    if ($plan) {


        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data'] = $plan;
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = '获取数据失败';
    }


    echo json_encode($res);
});


/**
 * @api {get} /helper/message 获取消息列表
 * @apiDescription type1为请假；2为出差,3为待考核
 * @apiName getmessage
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/helper/message
 */

$app->map(['GET', 'POST'], '/message', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $meid = $data->id;

    $plan = \ORM::for_table('messages')->where_equal("user_id", $meid)->find_array();

    if ($plan) {
        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data'] = $plan;
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = '获取数据失败';
    }

    echo json_encode($res);
});

/**
 * @api {get} /helper/message_unread_count 获取未读消息总数
 * @apiDescription type1为请假；2为出差
 * @apiName message_unread_count
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiSampleRequest /v1/helper/message_unread_count
 */

$app->map(['GET', 'POST'], '/message_unread_count', function ($request, $response, $args) {
    $res = array();
    $data = check($this->request);
    $meid = $data->id;

    $plan = \ORM::for_table('messages')
        ->where_equal("user_id", $meid)
        ->where_equal("is_read", 0)
        ->count();

    if ($plan) {
        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data'] = $plan;
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = '获取数据失败';
    }

    echo json_encode($res);
});


/**
 * @api {get} /helper/message_read 将未读消息设为已读
 * @apiName message_read
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.

 * @apiSampleRequest /v1/helper/message_read
 */

$app->map(['GET', 'POST'], '/message_read', function ($request, $response, $args) {
    $res = array();
    $my = check($this->request);

    $plan = \ORM::for_table('messages')
        ->where_equal("user_id", $my->id)
        ->where_equal("is_read", 0)
        ->find_many();

    if ($plan) {
        foreach($plan as $k=>$v){
            $v->is_read = 1;
            $v->save();
        }

        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data'] = $plan;
    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = '获取数据失败';
    }

    echo json_encode($res);
});

//
//$app->map(['GET'], '/upload', function ($req, $res) {
//    echo '<form   class="form-horizontal" method="post" enctype="multipart/form-data">
//<input type="file" name="file" class="span6 m-wrap" name="image"/>
//<input type="submit" value="Submit" class="btn purple" />';
//});


/**
 * @api {post} /helper/upload  上传接口
 * @apiDescription  上传,返回的name值为图像的绝对地址
 * @apiName upload
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 * @apiParam {Int} type   类型 1为用户图像，2为考核细则，3为考核流程图，4为日志附件，5为其它.
 * @apiParam {String} title   上传表单的名称.
 * @apiParam {file} file   上传表单的名称.
 * @apiSampleRequest /v1/helper/upload
 */
$app->map(['POST','GET'], '/upload', function ($request, $response, $args) {



    $res = array();
    $request = $request->withAttribute("decode", "true");



      $my = check($request);

    $storage = new \Upload\Storage\FileSystem('upload');

    $file = new \Upload\File('file', $storage);
    $type = $this->request->getParam('type');
    $title = $this->request->getParam('title');


    $new_filename = uniqid();
    $file->setName($new_filename);
    $file->addValidations(array(
        // Ensure file is of type "image/png"
//         new \Upload\Validation\Mimetype('image/png','image/gif','image/bmp','image/jpeg'
//             ,'image/jpeg','application/msword','application/pdf','application/vnd.ms-excel'),

        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
        new \Upload\Validation\Size('20M')
    ));

    // Access data about the file that has been uploaded
    $data = array(
        'type' => $type,
        'title' => $title,
        'name' => C('img.url') . $file->getNameWithExtension(),
        'extension' => $file->getExtension(),
        'mime' => $file->getMimetype(),
        'size' => $file->getSize(),
        'md5' => $file->getMd5(),
        'width' => $file->getDimensions()['width'],
        'height' => $file->getDimensions()['height']
    );
    //dump($data);
    // Try to upload file
    try {
        // Success!
        $file->upload();
        $res['err_code'] = 0;
        $res['err_msg'] = "";
        $res['data'] = $data;
        $upload = \ORM::for_table("uploads")->create();
        $upload->type = $type;
        $upload->title = $title;
        $upload->name = $data['name'];
        $upload->extension = $data['extension'];
        $upload->user_id = $my->id;
        $upload->create_time = Carbon::now()->toDateTimeString();
        $upload->save();
        //dump($upload);

    } catch (\Exception $e) {
        // Fail!
        $errors = $file->getErrors();
        $res['err_code'] = 1;
        $res['err_msg'] = $errors;


    };

    echo json_encode($res);
});


/**
 * @api {post} /helper/upload_list  上传列表
 * @apiDescription   根据type返回上传列表
 * @apiName uploadList
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 *
 * @apiParam {Int} type    类型 1为用户图像，2为考核细则，3为考核流程图，4为日志附件，5为其它.
 * @apiSampleRequest /v1/helper/upload_list
 */
$app->map(['POST'], '/upload_list', function ($request, $response, $args) {

    $res = array();
    $data = check($this->request);

    $page = $this->request->getParam('page');
    if (!$page) {
        $page = 1;
    }

    $pageSize = 10;

    $type = $this->request->getParam('type');

    $task = \ORM::for_table('uploads');
    if ($type > 0) {
        $task->where_raw(sprintf("`type`='%s'", $type));

    };

    $count = rand(1, @ceil($task->count() / $pageSize));

    $data = $task->limit($pageSize)->offset(($page - 1) * $pageSize)
        ->order_by_desc('id')->find_array();

    $res['err_code'] = 0;
    $res['err_msg'] = "";
    $res['data'] = array('list' => $data, 'total' => $count);
    echo json_encode($res);


});


/**
 * @api {post} /helper/upload_delete  删除上传的内容
 * @apiDescription   删除上传的内容,只能删除本人上传的内容
 * @apiName uploadDelete
 * @apiGroup Helper
 * @apiHeader {String} Authorization 请求header部份增加Authorization 格式为 Bearer+空格+用户token.jwt的值.
 *
 * @apiParam {String} name    文件路径.
 * @apiSampleRequest /v1/helper/upload_delete
 */
$app->map(['POST'], '/upload_delete', function ($request, $response, $args) {

    $res = array();

    $my = check($this->request);
    $name = $this->request->getParam('name');
    $task = \ORM::for_table('uploads')->where_equal("user_id", $my->id)->where_equal("name", $name)->find_one();

    if ($task) {

        $file = ROOT . "public/upload/" . str_replace(C("img.url"), "", $name);

        if (file_exists($file) === true) {
            unlink($file);
            $task->delete();
            $res['err_code'] = 0;
            $res['err_msg'] = "删除成功";
        } else {
            $res['err_code'] = 1;
            $res['err_msg'] = "文件不存在，删除失败";
        }

    } else {
        $res['err_code'] = 1;
        $res['err_msg'] = "删除失败，记录不存在";
    }


    echo json_encode($res);


});

