<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/7/7
 * Time: 下午7:58
 */

////namespace LaneWeChat;
//
//use LaneWeChat\Core\Wechat;
//use LaneWeChat\Core\WeChatOAuth;
//use LaneWeChat\Core\UserManage;
//
////引入配置文件
//include_once __DIR__ . '/../../LaneWeChat/config.php';
////引入自动载入函数
//include_once __DIR__ . '/../../LaneWeChat/autoloader.php';
////调用自动载入函数
//AutoLoader::register();

include_once ROOT . 'app/lib/pmkoo.php';

include_once ROOT . '/app/route/func.php';
define("BASE","http://police.71an.com/v1");

use Carbon\Carbon;




function gettoken($username,$password){
    $request=Requests::post(BASE.'/user/login', array(), array('username'=>$username,'password'=>$password));
    $info= json_decode($request->body);

    if($info->err_code==0){
        $data=$info->data->token->jwt;
        $token="Bearer ".$data;
        return $token;
    }
}
$app->map(['GET', 'POST'], '/gettoken', function ($request, $response, $args) {

    echo gettoken('admin','123456');
});
//创建任务
function createTask(){
    $token=gettoken('diaocha','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $data['user_id']=10;
    $data['content']="create_task".\Carbon\Carbon::now()->toDateTimeString();


    $request=Requests::post(BASE.'/task/create', $token,$data);
    $data=json_decode($request->body);
    return $data;
}
//更新状态
function taskStatus(){
   // $t=createTask();
    $token=gettoken('wangchao','123456');
    $token=array('Authorization'=>$token);
    $data=array();


    $data['id']=153;
    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
    //dump($data);

    $request=Requests::post(BASE.'/task/status', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}

//更新状态
function myTask(){
    // $t=createTask();
    $token=gettoken('diaocha','123456');
    $token=array('Authorization'=>$token);
    $data=array();


//    $data['id']=125;
//    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
//    //dump($data);

    $request=Requests::post(BASE.'/task/my', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}

//公示任务
function publicTask(){
    // $t=createTask();
    $token=gettoken('diaocha','123456');
    $token=array('Authorization'=>$token);
    $data=array();


//    $data['id']=125;
//    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
//    //dump($data);

    $request=Requests::post(BASE.'/task/public_task', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}


//考核公示
function checkPublic(){
    // $t=createTask();
    $token=gettoken('zhengzhichu','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $a=array(3,3,4);
    echo json_encode($a);

     $data['ids']="[28,27]";
//    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
//    //dump($data);

    $request=Requests::post(BASE.'/check/public', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}

//考核公示
function user_statistics(){
    // $t=createTask();
    $token=gettoken('jiwei','123456');

    $token=array('Authorization'=>$token);

    $data=array();


    $data['user_id']=52;
 //    //dump($data);

    $request=Requests::post(BASE.'/user/user_statistics', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}


//考核公示
function my_statistics(){
//    // $t=createTask();
//    $token=gettoken('wangchao','123456');
//    $token=array('Authorization'=>$token);
//    echo $token;
//    exit;
//    $data=array();
//
//
//    $data['start_time']="2015-09-01";
//    $data['end_time']="2015-12-01";
//    //    //dump($data);
//
//    $request=Requests::post(BASE.'/user/my_statistics', $token,$data);
//    echo $request->body;
////    $data=json_decode($request->body);
////    dump($data);
//    return $data;
}

//修改密码
function changePwd(){
    // $t=createTask();
    $token=gettoken('zhaohu','123456');
    $token=array('Authorization'=>$token);
    $data=array();


    $data['user_id']=2;
    $data['password']="123456";
//    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
//    //dump($data);

    $request=Requests::post(BASE.'/member/change_pwd', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}


function noteStatus(){
    // $t=createTask();
    $token=gettoken('diaocha','123456');
    $token=array('Authorization'=>$token);
    $data=array();


    $data['id']=25;
    $data['public_flag']=1;
//    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
//    //dump($data);

    $request=Requests::post(BASE.'/note/status', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}


function notePublicList(){
    // $t=createTask();
    $token=gettoken('fuju','123456');
    $token=array('Authorization'=>$token);
    $data=array();


    $data['id']=1;
    $data['public_flag']=1;
//    $data['remark']="remark".\Carbon\Carbon::now()->toDateTimeString();
//    //dump($data);

    $request=Requests::post(BASE.'/note/public_note', $token,$data);
    echo $request->body;
//    $data=json_decode($request->body);
//    dump($data);
    return $data;
}

$app->map(['GET', 'POST'], '/ok', function ($request, $response, $args) {

    $rs = \ORM::for_table("users_sign")->raw_query('select DISTINCT user_id from users_sign ')->find_array();

    foreach ($rs as $key=>$v){
        $dd=\ORM::for_table("users_sign")->create();
        $dd->user_id=$v["user_id"];
        $dd->sign_time="2016-04-06 17:46:00";
        $dd->type=2;
        $dd->save();

    }


//
});

$app->map(['GET', 'POST'], '/okk', function ($request, $response, $args) {
echo '
    <form action="/v1/test/ok" method="post">
	<input id="email" name="email">
	<input id="password" type="password" name="passowrd">
	<input type="checkbox" id="id_remember_user">
	<input type="submit" class="ok">
</form>';
//
});

function census(){
    \ORM::raw_execute("truncate   table census");
    // $t=createTask();
    $token=gettoken('keyuan','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $data["type"]=3;
    $data['status']=1;
    $data['json']=json_encode(array("name"=>"张三慧","sex"=>2));

    $request=Requests::post(BASE.'/census/create', $token,$data);
    echo $request->body;

}

//suozhang  daduizhang
function census_check_in(){
    // $t=createTask();
    $token=gettoken('wangyong','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $data["id"]=5;
    $data['reason']="asdf";
    //$data['json']=json_encode(array("name"=>"张三慧","sex"=>2));

    $request=Requests::post(BASE.'/census/recreate', $token,$data);
    echo $request->body;

}//suozhang  daduizhang
function census_process(){
    // $t=createTask();
    $token=gettoken('suozhang','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $data["id"]=1;
    $data['reason']="asdf";
    //$data['json']=json_encode(array("name"=>"张三慧","sex"=>2));

    $request=Requests::post(BASE.'/census/processing', $token,$data);
    echo $request->body;

}


function census_mylist(){
    // $t=createTask();
    $token=gettoken('daduizhang','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $data["id"]=1;
    $data['reason']="asdf";
    //$data['json']=json_encode(array("name"=>"张三慧","sex"=>2));

    $request=Requests::post(BASE.'/census/mylist', $token,$data);
    echo $request->body;

}



function census_search(){
    // $t=createTask();
    $token=gettoken('chengang','123456');
    $token=array('Authorization'=>$token);
    $data=array();

    $data["id"]=1;
    $data['reason']="asdf";
    //$data['json']=json_encode(array("name"=>"张三慧","sex"=>2));

    $request=Requests::post(BASE.'/census/recreate', $token,$data);
    echo $request->body;

}
$app->map(['GET', 'POST'], '/test', function ($request, $response, $args) {

    // createTask();
  //    census();
   //  census_process();
    census_search();
    // notePublicList();
//
});

$app->map(['GET', 'POST'], '/test1', function ($request, $response, $args) {

    // createTask();
    //census_mylist();

//    $department = \ORM::for_table('department')->where("name", "治安管理大队")->find_one();
//    //dump($department);
//    define("DADUI", $department->id);
//
//    echo DADUI;
    //  census_process();
    census_search();
    // notePublicList();
//
});

$app->map(['GET', 'POST'], '/power', function ($request, $response, $args) {

    error_reporting(-1);
    getUserDetail1(29);
});
//获取用户信息
function getUserDetail1($id)
{
    $user = \ORM::for_table('users')->find_one($id);

    if ($user) {
        $ids=explode(",",$user->department_id);
        $department = \ORM::for_table('department')->where_in("id", $ids)->find_many();

        $user->department_name = $department[0]['name'];


        $rs = \ORM::for_table('users_power')->where("user_id", $id)->find_array();
        $tmp = array();
        if ($rs) {
            foreach ($rs as $k => $v) {
                $tmp[] = $v["power_level"];
            }
        };

        $user->power=$tmp;
        dump($user);
        return $user;
    } else {
        return false;
    }
}
