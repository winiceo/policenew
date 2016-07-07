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
define("BASE","http://71an.com:9999/v1");

use Carbon\Carbon;

function gettoken(){
    $request=Requests::post(BASE.'/user/login', array(), array('username'=>'wangchao','password'=>'123456'));
    $info= json_decode($request->body);

    if($info->err_code==0){
        $data=$info->data->token->jwt;
        $token="Bearer ".$data;
        return $token;
    }

    //$token=array('Authorization'=>$token);

}
$app->map(['GET', 'POST'], '/gettoken', function ($request, $response, $args) {

 echo gettoken();
});

$app->map(['GET', 'POST'], '/test', function ($request, $response, $args) {


    $token=gettoken();

    $token=array('Authorization'=>$token);
    $data=array();

    $data['id']=111;
     $data['remark']="ok";

    //$request=Requests::post(BASE.'/plan/create', $token,$data);
    $request=Requests::post(BASE.'/task/status', $token,$data);
    //$request=Requests::get(BASE.'/test/sign_out', $token);


//$request=Requests::post('http://localhost:8080/query', array(), array('col'=>'Feeds','q'=>'{"eq":2,"in":[title]}'));

//http://localhost:8080/query?col=Feeds&q={%22eq%22:%2212%22,%22in%22:[%22title%22]}

//$request=Requests::post('http://localhost:8080/getjwt', array(), array('user'=>'admin','pass'=>''));


//$request=Requests::post('http://localhost:8080/checkjwt', array('Authorization'=>'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb2xsZWN0aW9ucyI6W10sImVuZHBvaW50cyI6W10sImV4cCI6MTQzNjg3Njc5MywidXNlciI6ImFkbWluIn0.QgTmD1BO3hiDZHnf6wEPjoh_GzuJE3pIG8gmFJkiuGZWkzCQ81zodsGwhIT1KboN_TBD7iemtoeLgaipZpm0wTJSlJKNxXIX4TS-YWgvWvnXw5t_l7h2uKqgtcifLaRIbiacUM8iV2lfsRRjOAk7kfhA6oVT7ldQklKz7kYiLiA'), array('user'=>'admin','pass'=>''));

//echo json_encode(array('q'=>'{"eq": "12", "in": ["title"]}'));
     echo  ($request->body);
//
});



$app->map(['GET', 'POST'], '/sign', function ($request, $response, $args) {

    for($i=1;$i<100;$i++){
        $arr=range(00,59);
        shuffle($arr);
//       $tomorrow =  Carbon::create(2015,6,7,8,$arr[0])->addDay(-19);
//        $arr=range(00,59);
        shuffle($arr);
        $user = \ORM::for_table('users_sign')->create();
        $user->sign_time = Carbon::create(2015,6,7,17,$arr[0])->addDay($i);
        $user->user_id = 52;
        $user->type = 2;

        $user->save();


    }

   ;
    exit;
});


$app->map(['GET', 'POST'], '/view', function ($request, $response, $args) {

//    $user=\ORM::for_table('users')->where_null("level")->find_one();
//
//    $user->level=getJob(trim($user->job))["sign"];
//    $user->save();
//    dump($user);
    //dump($data);

echo binplus('10','10');

});







$app->map(['GET', 'POST'], '/test1', function ($request, $response, $args) {

    $whitelist = array('jpg', 'jpeg', 'png', 'gif');
    $name      = null;
    $error     = 'No file uploaded.';

    if (isset($_FILES)) {
        if (isset($_FILES['file'])) {
            $tmp_name = $_FILES['file']['tmp_name'];
            $name     = basename($_FILES['file']['name']);
            $error    = $_FILES['file']['error'];

            if ($error === UPLOAD_ERR_OK) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                if (!in_array($extension, $whitelist)) {
                    $error = 'Invalid file type uploaded.';
                } else {
                    move_uploaded_file($tmp_name, $name);
                }
            }
        }
    }

    echo json_encode(array(
        'name'  => $name,
        'error' => $error,
    ));
    die();

});

$app->map(['GET', 'POST'], '/test2', function ($request, $response, $args) {


      //dump(createYmdRange("2015-06-07","2015-08-07"));
    $my=check($request);
    dump($my);


});

function createYmdRange2($ymdStart, $ymdEnd = true, $range = 86400)
{
    if ($ymdEnd === true) $ymdEnd = date('Y-m-d');

    return array_map(function ($time) {
        return date('Y-m-d', $time);
    }, range(strtotime($ymdStart), strtotime($ymdEnd), $range));
}
//
//function getSetting(){
//    $plan = \ORM::for_table('settings')->select_many('key','value')->find_array();
//    $tmp=array();
//    foreach($plan as $k=>$v){
//        $tmp[$v["key"]]=$v['value'];
//    }
//    return $tmp;
//
//}
////获取单个人，指定月份的签到情况
//function getMySign2($userid,$year_month){
//
//    $sql=sprintf("select `type`, DATE_FORMAT(sign_time,'%%H:%%i:%%s') as sign_time from users_sign where user_id=%s and DATE_FORMAT(sign_time,'%%Y-%%m')='%s'",$userid,$year_month);
//
//
//    $data=\ORM::for_table('users_sign')->raw_query($sql)->find_array();
//    $config=getSetting();
//    $tmp=array();
//    $tmp['data']=array();
//    $tmp['sign_in']=0;
//    $tmp['sign_out']=0;
//
//    foreach ($data as $k=>$v) {
//
//        if($v['type']==1&&strtotime($v['sign_time'])>strtotime($config['sign_in_time'])){
//            $v['flag']=1;
//            $tmp['sign_in']++;
//        }else if($v['type']==2&&strtotime($v['sign_time'])<strtotime($config['sign_out_time'])){
//            $v['flag']=1;
//            $tmp['sign_out']++;
//        }
//        $tmp['data'][]=$v;
//    }
//
//    return $tmp;
//
//}
//
////获取单个人，指定月份的请假记录
//function getMyEvents($userid,$year_month){
//
//    $sql=sprintf("select * from users_sign where user_id=%s and DATE_FORMAT(sign_time,'%%Y-%%m')='%s'",$userid,$year_month);
//
//    $data=\ORM::for_table('users_sign')->raw_query($sql)->find_array();
//    return $data;
//
//}
//
//
//
//
//
//

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
$app->map(['GET','POST'], '/upload', function ($request, $response, $args) {



    $res = array();

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
        'name' => "http://71an.com:9999/upload/" . $file->getNameWithExtension(),
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









