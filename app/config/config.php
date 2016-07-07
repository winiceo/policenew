<?php
/**
 * 配置文件
 * db.read 只读数据库配置
 * db.write读写数据库配
 * log.path日志配置
 */
$configure = array(
    "version" => "1.0.0",
    "server_name"=>'pmkoo_seller',
    "jwtKey"=>'@#$DFADFQWRasdf%$^#$%^',
    "db.driver" => 'mysql',
//    "db.host" => 'www.pmkoo.com',
//    "db.dbname" => 'wechat',
//    "db.username" => 'wanzhuan',
//    "db.password" => 'wanzhuan#1101',

//    "db.host" => '123.56.136.85',
//    "db.dbname" => 'pmker2',
//    "db.username" => 'pmkoo',
//    "db.password" => 'pmkoo',
    "db.host" => 'police.71an.com',

    "db.dbname" => 'polic',
    "db.username" => 'leven',
    "db.password" => '56OS.COM',

    /*
     "db.read.host" => 'localhost',
     "db.read.dbname" => 'pmker',
     "db.read.username" => 'wanzhuan',
     "db.read.password" => 'wanzhuan#1101',*/

    "log.path" => '/data/logs/police/',

    'ip.limit'=>array( ),

    'redis.ip'=>'127.0.0.1',
    'redis.port'=>6380,

    'ssdb.ip'=>'127.0.0.1',
    'ssdb.port'=>6688,
    'html.url'=>'http://static.pmkoo.com/',
    'img.url'=>"http://police.71an.com/upload/",

    'mail.to'=>array('861299678@qq.com','zshdiy@163.com'),
    'xg.access.id'=>'2100139300',
    'xg.access.key'=>'ASK6IN2Q914X',
    'xg.secret.key'=>'4920a4f4125ce1a99a00dee2dcfeeb79',


);
/**
 * 需要全局定义
 * Agentid，Source，MerchantKey 为19pay所需验证信息
 *
 * CHUID,CHPWD,VER,KeyStr为欧飞所需验证信息
 * OF_QQ,OF_ZFB 分别为欧飞qq、支付宝业务识别码
 * CREDIT_LIMIT为用户单日最高限额
 */
$configure['define'] = array(
    'YUNTU_API_KEY'=> 'c1aec7db35148b29f7de681963fb6b6d',

    'YUNTU_API_URL_PRE'=> 'http://yuntuapi.amap.com/datamanage',
    'YUNTU_API_SIGN'=> '1c7fcfb8d1ce11993652b7d6c2d41423',
    'YUNTU_API_TABLEID'=>"559359a9e4b0be7f7a935fce",
    "PAGESIZE" => 10,
);


return $configure;
 
