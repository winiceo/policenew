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

$app->map([ 'GET','OPTIONS'], '/mobile_save/{oid}/{mobile}', function ($request, $response, $args) {
    $order_id=$args['oid'];
    $mobile=$args['mobile'];

    $share_order = \ORM::for_table('share_order_info')
        ->where('order_no', $order_id)
        ->where('mobile','')
        ->find_one();
    if (!$share_order) {
        $res['errocode'] = 1;
        $res['erromsg'] = "此订单不存在，或已被人领走";
        return json_encode($res);
    };
    $order = \ORM::for_table('order_info')->where('order_no', $order_id)->find_one();
    if(!$order){
        $res['errocode']=1;
        $res['erromsg']="此订单不存在，或已被人领走";
        return json_encode($res);
    }
    $goods = \ORM::for_table('goods')->where('id',$order->goods_id)->find_one();
    if(!$goods){
        $res['errocode']=1;
        $res['erromsg']="此订单不存在，或已被人领走";
        return json_encode($res);
    }
    $share_order->mobile=$mobile;
    $share_order->save();
    $res['errocode']=0;
    $res['erromsg']=sprintf("此订单已存入您手机号：%s下，如果你还没有用屏媒，请下载使用",$mobile);
    return json_encode($res);





});

$app->map([ 'GET'], '/odetail/{oid}', function ($request, $response, $args) {
    include_once __DIR__ . '/../lib/pmkoo.php';
    $order_id=$args['oid'];
    $key_id='php_share_order_id:'.$order_id;
    $order_info=Pmker::cache($key_id);
    $res=array();
    $res['data']="";
    if(!$order_info){
        $order = \ORM::for_table('share_order_info')
            ->where('order_no', $order_id)
            ->where('mobile','')
            ->find_one();
        if(!$order){
            $res['errocode']=1;
            $res['erromsg']="此订单不存在，或已被人领走";
            return json_encode($res);
        }

        $order = \ORM::for_table('order_info')->where('order_no', $order_id)->find_one();
        if(!$order){
            $res['errocode']=1;
            $res['erromsg']="此订单不存在，或已被人领走";
            return json_encode($res);
        }
        $goods = \ORM::for_table('goods')->where('id',$order->goods_id)->find_one();
        if(!$goods){
            $res['errocode']=1;
            $res['erromsg']="此订单不存在，或已被人领走";
            return json_encode($res);
        }else{
            $res['errocode']=0;
            $res['data']=array('name'=>$goods->name,'img'=>$goods->img_2_1);
            $order_info= json_encode($res);
            Pmker::cache($key_id,$order_info);//写入缓存
        }

        return $order_info;
    }else {
        $order = \ORM::for_table('share_order_info')
            ->where('order_no', $order_id)
            ->where('mobile','')
            ->find_one();
        if (!$order) {
            $res['errocode'] = 1;
            $res['erromsg'] = "此订单不存在，或已被人领走";
            return json_encode($res);
        };
        return $order_info;
    }


});