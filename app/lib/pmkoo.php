<?php
/*
* 数据库读写分离，默认为读数据库
* author:zhao shaohui
* update_time :2014/6/4
*/

/*
 写数据库配置
*/
define("LIBPATH", str_replace("\\", "/", dirname(__FILE__)));
 
define("IMAGE_PATH","http://182.92.212.64/");
require ROOT.'/app/lib/SSDB.php';
require ROOT.'/app/lib/idiorm.php';

ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

\ORM::configure(sprintf('mysql:host=%s;dbname=%s', C('db.host'), C('db.dbname')));

\ORM::configure('username', C('db.username'));
\ORM::configure('password', C('db.password'));
\ORM::configure('return_result_sets', true);
\ORM::configure('logging', true);
\ORM::configure('logger', function ($log_string) use ($app) {

   $logpath="/data/logs/";

    error_log($log_string . "\n", 3, $logpath . 'police_sql.log');
    //echo $logpath . 'police_sql.log';
});


class Pmker
{
    public static $app;
    public static $error_code = array(
        
    );



    /**
     * 记录日志
     * @param $params
     */
    public static function log($params)
    {
        $logpath = C('log.path');
        if (!is_dir($logpath)) {
            mkdir($logpath, 0777, true);
        }
        $response = array();
        if (is_array($params)) {
            $response = array_merge(array("datetime" => date('Y-m-d H:i:s')), $params);
        } elseif (is_string($params)) {
            $response['msg'] = $params;
        }
        $log_file = $logpath. date("Ymd");
        error_log(json_encode($response) . "\n", 3, $log_file);
    }
	public static function ssdb()
    {
        static $_ssdb;


        if ($_ssdb === null) {
            try {
                $_ssdb = new SimpleSSDB(C("ssdb.ip"), C('ssdb.port'));
            } catch (Exception $e) {

                $_ssdb = null;
                self::log('ssdb start fail');
            }
        }

        return $_ssdb;
    }

    /**
     * redis 队列
     * @return redis
     */
    public static function redis()
    {
        static $_cache;
        if ($_cache === null) {
            $_cache = new redis();
            $_cache->connect("127.0.0.1", "9701");
        }
        return $_cache;
    }
 
    /**
     * 缓存数据
     * @param $key
     * @param null $value
     * @param int $time
     * @return bool|mixed|null
     */
    public static function cache($key, $value = null, $time = 0)
    {
		//return null;
        $_cache = Pmker::ssdb();
        $key = strtoupper($key);
        if (!is_null($value)) {
            return $_cache->set($key, json_encode($value), $time);
        }
        if (empty($key)) {
            return $_cache->flushAll();
        }

        $v = $_cache->get($key);
        return isset($v) ? json_decode($v, TRUE) : NULL;
    }

    /**
     * 缓存数据
     * @param $key
     * @param null $value
     * @param int $time
     * @return bool|mixed|null
     */
    public static function clear_cache($key)
    {
		return null;
        $_cache = Pmker::ssdb();
        $key = strtoupper($key);
       // $_cache->delete($_cache->keys($key));
    }

    /**
     * @return string
     * 生成订单号
     */
    public static function uuid()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        return date('Ymdhis') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

     

}
