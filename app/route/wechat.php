<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/7/7
 * Time: 下午7:58
 */

namespace LaneWeChat;
use LaneWeChat\Core\Wechat;
use LaneWeChat\Core\WeChatOAuth;
use LaneWeChat\Core\UserManage;
use LaneWeChat\Core\TemplateMessage;

//引入配置文件
include_once __DIR__.'/../../LaneWeChat/config.php';
//引入自动载入函数
include_once __DIR__.'/../../LaneWeChat/autoloader.php';
//调用自动载入函数
AutoLoader::register();



/**
 * 微信插件唯一入口文件.
 * @Created by Lane.
 * @Author: lane
 * @Mail lixuan868686@163.com
 * @Date: 14-1-10
 * @Time: 下午4:00
 * @Blog: Http://www.lanecn.com
 */

$app->map(['GET', 'POST'], '/index', function ($request, $response, $args) {


//初始化微信类
    $wechat = new WeChat(WECHAT_TOKEN, TRUE);


    //log(json_encode($_SERVER));

//首次使用需要注视掉下面这1行（26行），并打开最后一行（29行）
    echo $wechat->run();

    error_log($wechat->run() . "\n", 3,  '/data/logs/wechat.log');
//首次使用需要打开下面这一行（29行），并且注释掉上面1行（26行）。本行用来验证URL
    //$wechat->checkSignature();

});

$app->map(['GET', 'POST'], '/setmenu', function ($request, $response, $args) {


   // \LaneWeChat\Core\Menu::delMenu();
    //设置菜单
    $menuList = array(
        array('id'=>'1', 'pid'=>'',  'name'=>'商家入口', 'type'=>'', 'code'=>'key_1'),
        array('id'=>'2', 'pid'=>'1',  'name'=>'点击', 'type'=>'click', 'code'=>'key_2'),
        array('id'=>'3', 'pid'=>'1',  'name'=>'财富值', 'type'=>'view', 'code'=>'http://wechat.71an.com/seller/login'),
        array('id'=>'4', 'pid'=>'',  'name'=>'扫码', 'type'=>'', 'code'=>'key_4'),
        array('id'=>'5', 'pid'=>'4', 'name'=>'扫码带提示', 'type'=>'scancode_waitmsg', 'code'=>'key_5'),
        array('id'=>'6', 'pid'=>'4', 'name'=>'扫码推事件', 'type'=>'scancode_push', 'code'=>'key_6'),
        array('id'=>'7', 'pid'=>'',  'name'=>'发图', 'type'=>'', 'code'=>'key_7'),
        array('id'=>'8', 'pid'=>'7', 'name'=>'系统拍照发图', 'type'=>'pic_sysphoto', 'code'=>'key_8'),
        array('id'=>'9', 'pid'=>'7', 'name'=>'拍照或者相册发图', 'type'=>'pic_photo_or_album', 'code'=>'key_9'),
        array('id'=>'10', 'pid'=>'7', 'name'=>'微信相册发图', 'type'=>'pic_weixin', 'code'=>'key_10'),
        array('id'=>'11', 'pid'=>'1', 'name'=>'发送位置', 'type'=>'location_select', 'code'=>'key_11'),
    );
    $a=\LaneWeChat\Core\Menu::setMenu($menuList);

//dump($a);
//获取菜单
    $b= \LaneWeChat\Core\Menu::getMenu();

    dump($b);
//删除菜单

    exit;

});

//
//$app->map(['GET', 'POST'], '/seller/login', function ($request, $response, $args) {
//
//    include  __DIR__.'/LaneWeChat/lanewechat.php';
//
//    WeChatOAuth::getCode('http://wechat.71an.com/seller', 1, 'snsapi_userinfo');
//
//});
//$app->map(['GET', 'POST'], '/seller', function ($request, $response, $args) {
//
//    include  __DIR__.'/LaneWeChat/lanewechat.php';
//    include  __DIR__.'/LaneWeChat/lanewechat.php';
//
//    // WeChatOAuth::getCode('http://wechat.71an.com/seller', 1, 'snsapi_userinfo');
//    //此时页面跳转到了http://www.lanecn.com/index.php，code和state在GET参数中。
//    $code = $_GET['code'];
////第二步，获取access_token网页版
//    $openId = WeChatOAuth::getAccessTokenAndOpenId($code);
////第三步，获取用户信息
//    $userInfo = UserManage::getUserInfo($openId['openid']);
//    //dump($this);
//
//    $this->view->render($response,'seller.html', array(
//        'nickname' => $userInfo['nickname'],
//        'money' => 2222
//
//    ));
//    //dump($userInfo);
//
//})->setName('profile');;


