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


include_once __DIR__ . '/../lib/pmkoo.php';
include_once __DIR__ . '/../lib/XingeApp.php';


$app->map(['GET', 'POST'], '/kill', function ($request, $response, $args) {
    //Android 版
    //给单个设备下发通知



        $push = new XingeApp(C('xg.access.id'), C('xg.secret.key'));
        $mess = new Message();
        $mess->setTitle('killllllll');
        $mess->setContent('asfasdfasf');
        $mess->setType(Message::TYPE_NOTIFICATION);
        $mess->setStyle(new Style(0, 1, 1, 1, 0));
        $action = new ClickAction();

        $action->setActionType(ClickAction::TYPE_ACTIVITY);
        $action->setActivity("com.pmkooclient.pmkoo.activity.SeckillListActivity");
        $mess->setAction($action);
        $ret = $push->PushSingleAccount(0, "pmker_10008", $mess);
    dump($ret);
//        return $ret;
//
//    var_dump(XingeApp::PushTokenAndroid(C('xg.access.id'), C('xg.secret.key'), "title", "content", "token"));
//    //给单个帐号下发通知
//    var_dump(XingeApp::PushAccountAndroid(10000, "secretKey", "title", "content", "account"));
//    //给所有设备下发通知
//    var_dump(XingeApp::PushAllAndroid(10000, "secretKey", "title", "content"));
//    //给标签选中设备下发通知
//    var_dump(XingeApp::PushTagAndroid(10000, "secretKey", "title", "content", "tag"));
//
//
//    if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
//        $server->getResponse()->send();
//        die;
//    }
//
//    echo json_encode(array('code' => 0, 'response' => true, 'message' => null));
//


});