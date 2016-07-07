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

include_once ROOT . '/app/lib/pmkoo.php';

use Carbon\Carbon;

function check($request)
{
    $r = check_token($request);
    if (!$r) {


        $res['err_code'] = 1;
        $res['err_msg'] = "没有登录或登录已过期，重新登录";
        die(json_encode($res));

    } else {
        return $r;
    }
}

//简单级别权限验证
function checkAdmin($my,$level=array(),$allow_me=false){
    if(!in_array($my->level,$level)){
        if(!$allow_me){
            $res['err_code'] = 1;
            $res['err_msg'] = "对不起，您没有权限操作";
            die(json_encode($res));
        }


    }

}
/**
 * 验证
 */
function check_token($request)
{
    $authHeader = $request->getHeader('Authorization');
    $authHeader = join("", $authHeader);
    if($request->getAttribute('decode')){

        $authHeader=$request->getParam('Authorization');
         $authHeader = urldecode($authHeader);
    }

    error_log($authHeader . "\n\n\n", 3, "/data/logs/police_head.log");
    if ($authHeader) {

        list($jwt) = sscanf($authHeader, 'Bearer %s');

        if ($jwt) {
            try {
                //$config = Factory::fromFile('config/config.php', true);

                /*
                 * decode the jwt using the key from config
                 */
                $secretKey = base64_decode(C('jwtKey'));

                $token = JWT::decode($jwt, $secretKey, array('HS512'));


                return $token->data;


            } catch (Exception $e) {

                return false;
            }
        } else {
            /*
             * No token was able to be extracted from the authorization header
             */
            return false;
        }
    } else {
        return false;

    }

}

function user_sign($user_id, $type = 1)
{
    $res=array();
    $user = \ORM::for_table('users_sign')->create();
    $user->sign_time = Carbon::now()->toDateTimeString();
    $user->user_id = $user_id;
    $user->type = $type;

    $user->save();

    $res['err_code'] = 0;
    if ($type == 1) {
        $res['err_msg'] = "签到成功";
    } elseif ($type == 2) {
        $res['err_msg'] = "签退成功";
    }

    return $res;
}

//是否签过到
function user_is_sign($user_id,$type=1)
{
    $today = Carbon::now()->toDateString();

    $where = sprintf("`user_id`='%s' and DATE_FORMAT(`sign_time`,'%%Y-%%m-%%d')='%s' and type=%s", $user_id, $today,$type);

    $user = \ORM::for_table('users_sign')->where_raw($where)->find_one();
    if ($user) {
        return true;
    } else {
        return false;
    }

}


//5(4)->3->2-6-》1
function getJob($job=null){
    $jobs=array(
        array("name"=>"局长","sign"=>1),
        array("name"=>"政委","sign"=>1),
        array("name"=>"副局长","sign"=>2),
        array("name"=>"主任","sign"=>3),
        array("name"=>"副主任","sign"=>4),
        array("name"=>"大队长","sign"=>3),
        array("name"=>"教导员","sign"=>3),
        array("name"=>"副大队长","sign"=>4),
        array("name"=>"中队长","sign"=>4),
        array("name"=>"所长","sign"=>3),
        array("name"=>"副所长","sign"=>4),
        array("name"=>"科员","sign"=>5),
        array("name"=>"政治处","sign"=>6),
        array("name"=>"纪委督查","sign"=>7),
        array("name"=>"指挥中心","sign"=>8),

    );
    if($job==null){
        return $jobs;
    }else{
        foreach($jobs as $k=>$v){
            if($v["name"]==$job){
                return $v;
            }
        }
        return false;
    }

}

//获取配置信息
function getSetting(){
    $plan = \ORM::for_table('settings')->select_many('key','value')->find_array();
    $tmp=array();
    foreach($plan as $k=>$v){
        $tmp[$v["key"]]=$v['value'];
    }
    return $tmp;

}
//获取单个人，指定月份的签到情况
function getMySign($userid,$start_time,$end_time){

    $sql=sprintf("select `type`,  sign_time from users_sign where user_id=%s and DATE_FORMAT(sign_time,'%%Y-%%m-%%d')>='%s' and DATE_FORMAT(sign_time,'%%Y-%%m-%%d')<='%s'",$userid,$start_time,$end_time);


    $data=\ORM::for_table('users_sign')->raw_query($sql)->find_array();
    $config=getSetting();
    $tmp=array();
    $tmp['data']=array();
    $tmp['sign_in']=0;
    $tmp['sign_out']=0;

    foreach ($data as $k=>$v) {
        $date=Carbon::createFromFormat('Y-m-d H:i:s', $v['sign_time'])->format('Y-m-d');
        $time=Carbon::createFromFormat('Y-m-d H:i:s', $v['sign_time'])->format('H:i:s');
        if($v['type']==1){

            $tmp['data'][$date]['sign_in']=$time;
            if(strtotime($time)>strtotime($config['sign_in_time'])){
                $tmp['data'][$date]['states'][]=1;
                $tmp['sign_in']++;
            }

        }
        if($v['type']==2){

            $tmp['data'][$date]['sign_out']=$time;
            if(strtotime($time)<strtotime($config['sign_out_time'])){
                $tmp['data'][$date]['states'][]=2;
                $tmp['sign_out']++;
            }

        }
//        if($v['type']==1&&strtotime($time)>strtotime($config['sign_in_time'])){
//            $v['flag']=1;
//            $tmp['sign_in']++;
//        }else if($v['type']==2&&strtotime($time)<strtotime($config['sign_out_time'])){
//            $v['flag']=1;
//            $tmp['sign_out']++;
//        }

    }

    return $tmp;

}
//审核通过标志：status=2&&check_user_id=0;
//获取单个人，指定月份的请假记录
function getMyEvents($userid,$start_time,$end_time,$type=1){

    $sql=sprintf("select * from users_event where user_id=%s and check_user_id=0 and type=%s and status=2",$userid,$type);

    $data=\ORM::for_table('users_event')->raw_query($sql)->find_array();
    $days=array();
    foreach($data as $k=>$v){
        $days=array_merge($days,createYmdRange($v['start_time'],$v['end_time']));
    }
    $days=array_unique($days);
    sort($days);

    $tmp=array();
    foreach($days as $k=>$v){
        $re=Carbon::parse($v)->between(Carbon::parse($start_time),Carbon::parse($end_time));
        if($re==1){
            $tmp[]=$v;
        }
    }
    $res=array();
    $res['list']=$tmp;
    $res['count']=count($tmp);
    return $res;

}
//审核流程
function checkFlow($user_id,$type){


}

//获取用户信息
function getUserInfo($id){
    $user = \ORM::for_table('users')->find_one($id)->as_array();
    if($user){

        return $user;
    }else{
        return false;
    }
}

//获取用户审核流程
function getFlow($user_id){
    $user=getUserInfo($user_id);

    $data=getNextFlow($user);

    return $data;


}
//获取用户信息
function getNextFlow($user){

    $data=\ORM::for_table('users')->select_many('id','real_name','job','department_id')->find_array();
    $tmp=array();
    $flow=array();
    $check_user_id=array();
    foreach($data as $k=>$v){
        $v['level']=getJob(trim($v['job']))["sign"];
        $v['status']=1;
        $v['check_time']="";
        $v['reason']="";
        $tmp[$v['level']][]= $v;

    }

    if($user['level']==5||$user['level']==4){
        foreach($tmp[3] as $k=>$v){

            if(in_array($user['department_id'],explode(";", $v['department_id']))){
                $flow["one"][]=$v;
                $check_user_id[]=$v['id'];
            };
        }

        foreach($tmp[2] as $k=>$v){

            if(in_array($flow["one"][0]['department_id'],explode(";", $v['department_id']))){
                $flow["two"][]=$v;
            };
        }
    }elseif($user['level']==3){
        foreach($tmp[2] as $k=>$v){
            if(in_array($user['department_id'],explode(";", $v['department_id']))){
                $flow["two"][]=$v;
                $check_user_id[]=$v['id'];
            };
        }
    }



    foreach($tmp[6] as $k=>$v){
        $flow["three"][]=$v;
        if(count($check_user_id)==0){
            $check_user_id[]=$v['id'];
        }

    }
    $flow["four"]=$tmp[1];

    return array("data"=>$flow,"check_user_id"=>implode(';',$check_user_id));


}

function notice($user_id,$type,$data){
    $message=\ORM::for_table("messages")->create();
    $message->user_id=$user_id;
    $message->type=$type;
    $message->data=json_encode($data);
    $message->save();

}
//返回一个时间段内的天数
function createYmdRange($ymdStart, $ymdEnd = true, $range = 86400)
{
    if ($ymdEnd === true) $ymdEnd = date('Y-m-d');

    return array_map(function ($time) {
        return date('Y-m-d', $time);
    }, range(strtotime($ymdStart), strtotime($ymdEnd), $range));
}

function binplus($arg1,$arg2)
{
    if ($arg1 == '' || $arg2 == '') {
        return false;
    }
    $tmpsum = bindec($arg1) + bindec($arg2);
    return decbin($tmpsum);

}
