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

include ROOT ."app/lib/Snoopy.class.php";
require ROOT.'app/lib/phpQuery/phpQuery.php';
use Carbon\Carbon;

$app->map(['GET', 'POST'], '/data', function ($request, $response, $args) {


    $connection = new MongoClient("mongodb://71an.com:2706");
    $db = $connection->craws;
    $collection = $db->webs;
    $data = $collection->find(array("craw"=>true));

    echo '<table border="1">';
    echo '<tr><td>名称</td><td>网址</td><td>开发商网址</td><td>开发商</td><td>开发者网站</td><td>邮箱</td><td>类型</td><td>下载量</td><td>国家</td></tr>';
    foreach($data as $k=>$v){

       echo "<tr>";
        unset($v["_id"]); unset($v["__v"]); unset($v["craw"]);
        foreach($v as $m=>$n){
            echo "<td>".$n."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";


});
$app->map(['GET', 'POST'], '/test', function ($request, $response, $args) {


craw();
    sleep(10);
    header('Location: /v1/craw/test');


});
$app->map(['GET', 'POST'], '/get', function ($request, $response, $args) {
   $url=$this->request->getParam('url');


    $snoopy = new Snoopy;

    $snoopy->rawheaders["X_FORWARDED_FOR"] = "111.13.101.208"; //伪装ip
    $snoopy->proxy_host ="124.160.194.72";
    $snoopy->agent = "(compatible; MSIE 4.01; MSN 2.5; AOL 4.0; Windows 98)";
    $snoopy->referer = "http://www.baidu.com";
   // $snoopy->referer = "https://www.appannie.com/apps/google-play/top/united-states/";
    $snoopy->rawheaders["COOKIE"]='__distillery=v20150227_84213714-76ee-4eee-9f8e-b9f40c77ecf4; optimizelyEndUserId=oeu1450285390393r0.6702146432362497; km_lv=x; aa_language=cn; django_language=zh-cn; selection_key=c463e79bdd66f0e12777efd2f13f0d19; _mkto_trk=id:071-QED-284&token:_mch-appannie.com-1450487810316-32864; __unam=e349de3-151dd097ef5-701abc98-10; optimizelySegments=%7B%222069170486%22%3A%22false%22%2C%222083860069%22%3A%22gc%22%2C%222083940003%22%3A%22direct%22%2C%223519320656%22%3A%22none%22%7D; optimizelyBuckets=%7B%7D; aa_user_token=".eJxrYKotZNQI5SxNLqmIz0gszihkClUwTzFNNUpMtrA0MkoxMzBLMTY2NEtONjM1S7JMNU0yMAkVik8sLcmILy1OLYpPSkzOTs1LKWQONShPTUrMS8ypLMlMLtZLTE7OL80r0XNOLE71zCtOzSvOLMksS_XNT0nNcYLqYQnlRTIpM6WQ1evHCU6GUj0AsUk0Qw:1aCm54:IRA5upgLuitHh9-yXQW6enBMvVU"; csrftoken=i8iDYA1N3Zwzdlm7e7IJuTNL9G8u5mHI; sessionId=".eJxNjj1Lw1AUhttaq6bWr7GTo4KEJJWErnbSokPxzJebe0_oJfHm45xUIghOov_K0b_g5N9w1EAVt2d4Ht73qfdYdk_gkJDI5LbAigwxWn6B7SQWFXLVwMAPgvBsAqO1JYhlxfMOjISseSlqwkoYffX1vtOB_V8JrYwz1PMe9CUZfQNDzknUhZaMuuy9wtG_OpYqRavBu8dYWpk1bBS5Uqm8tuzOJOGlJbRk2KzwOteYXayLn1MZKm4XU2zgWJ2HE4ymsdZhmHjoB1EUYaKDxJ8knvancCAzrFioJapUsLlD1T5qwfmDcgOcrc_d8d542P14U0XDD46A25lT9k8X5ebzohzU7jet629Y:1aCpnP:xGFiEjvSfTDSPA7kPnZxaoKf80Q"; _ga=GA1.2.1534050283.1450278427; __atuvc=31%7C50%2C54%7C51; _bizo_bzid=012eae64-0b1d-4909-b1ee-6ae81781918c; _bizo_cksm=F5039A47D77674A8; _bizo_np_stats=14%3D655%2C; kvcd=1451139979577; km_ai=leven%4071an.com; km_ni=leven%4071an.com; km_uq=';
    $snoopy->fetch($url);
    $html= $snoopy->results;
    echo $html;


});
function craw(){
    $connection = new MongoClient("mongodb://71an.com:2706");
    $db = $connection->craws;
    $collection = $db->webs;
    $data = $collection->findOne(array("craw"=>array('$ne'=>true)));
    dump($data);

    $url="https://www.appannie.com".$data["weburl"];
    $snoopy = new Snoopy;
    $snoopy->proxy_host ="124.160.194.72";

    $snoopy->agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-
CN; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5 FirePHP/0.2.1";
    $snoopy->rawheaders["X_FORWARDED_FOR"] = "111.13.101.208"; //伪装ip

    $snoopy->referer = "https://www.appannie.com/apps/google-play/top/united-states/";
    $snoopy->rawheaders["COOKIE"]='__distillery=v20150227_84213714-76ee-4eee-9f8e-b9f40c77ecf4; optimizelyEndUserId=oeu1450285390393r0.6702146432362497; km_lv=x; aa_language=cn; django_language=zh-cn; selection_key=c463e79bdd66f0e12777efd2f13f0d19; _mkto_trk=id:071-QED-284&token:_mch-appannie.com-1450487810316-32864; __unam=e349de3-151dd097ef5-701abc98-10; optimizelySegments=%7B%222069170486%22%3A%22false%22%2C%222083860069%22%3A%22gc%22%2C%222083940003%22%3A%22direct%22%2C%223519320656%22%3A%22none%22%7D; optimizelyBuckets=%7B%7D; aa_user_token=".eJxrYKotZNQI5SxNLqmIz0gszihkClUwTzFNNUpMtrA0MkoxMzBLMTY2NEtONjM1S7JMNU0yMAkVik8sLcmILy1OLYpPSkzOTs1LKWQONShPTUrMS8ypLMlMLtZLTE7OL80r0XNOLE71zCtOzSvOLMksS_XNT0nNcYLqYQnlRTIpM6WQ1evHCU6GUj0AsUk0Qw:1aCm54:IRA5upgLuitHh9-yXQW6enBMvVU"; csrftoken=i8iDYA1N3Zwzdlm7e7IJuTNL9G8u5mHI; sessionId=".eJxNjj1Lw1AUhttaq6bWr7GTo4KEJJWErnbSokPxzJebe0_oJfHm45xUIghOov_K0b_g5N9w1EAVt2d4Ht73qfdYdk_gkJDI5LbAigwxWn6B7SQWFXLVwMAPgvBsAqO1JYhlxfMOjISseSlqwkoYffX1vtOB_V8JrYwz1PMe9CUZfQNDzknUhZaMuuy9wtG_OpYqRavBu8dYWpk1bBS5Uqm8tuzOJOGlJbRk2KzwOteYXayLn1MZKm4XU2zgWJ2HE4ymsdZhmHjoB1EUYaKDxJ8knvancCAzrFioJapUsLlD1T5qwfmDcgOcrc_d8d542P14U0XDD46A25lT9k8X5ebzohzU7jet629Y:1aCpnP:xGFiEjvSfTDSPA7kPnZxaoKf80Q"; _ga=GA1.2.1534050283.1450278427; __atuvc=31%7C50%2C54%7C51; _bizo_bzid=012eae64-0b1d-4909-b1ee-6ae81781918c; _bizo_cksm=F5039A47D77674A8; _bizo_np_stats=14%3D655%2C; kvcd=1451139979577; km_ai=leven%4071an.com; km_ni=leven%4071an.com; km_uq=';
    $snoopy->fetch($url);
    $html= $snoopy->results;
    echo $html;
    exit;
    phpQuery::newDocumentHTML($html);
    //
    // $collection->update(array("name" => "caleng"), $newdata);

    $data["devlop"]=pq(".summary-item:eq(2) a")->attr("href");
    $data["apppublisher"]=pq(".summary-item:eq(2) a")->text();
    $data["website"]=pq(".app-box-content  li:eq(0) a")->attr("href");
    $data["email"]=pq(".app-box-content  li:eq(1) a")->attr("href");
    $data["type"]=pq(".about_app .app-box-content  p:eq(2)")->text();
    $data["downnum"]=pq(".about_app .app-box-content  p:eq(5)")->text();

    $data["craw"]=true;

    $where=array("_id"=>$data["_id"]);

    $result=$collection->update($where,$data); #$set:让某节点等于给定值,类似的还有$pull $pullAll
    dump($result);
    //craw();
}