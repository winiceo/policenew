<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/7/7
 * Time: 下午4:31
 */


require './app/lib/pmkoo.php';




require './app/lib/Curl/Curl.php';
use \Curl\Curl;


/*
 * 创建云图表
 * */
$app->get('/yuntu/table/create',function () use ($app)  {



    $data = array(

        'key' =>YUNTU_API_KEY,
        'name' => '河北屏媒',
        'sig' =>  YUNTU_API_SIGN,

    );

    $curl = new Curl();
    $curl->setHeader('Content-Type', 'application/x-www-form-urluncoded');
    //$curl->setBasicAuthentication(GRATIPAY_API_KEY);
    $curl->post(YUNTU_API_URL_PRE."/table/create" , $data);


    dump ($curl->response);



});

$app->get('/yuntu/data/create',function () use ($app)  {


    $store_info=array(
        "_name"=>'云摄影222',
        // '_description'=>'我',
        '_location'=>'',
        '_address'=>'石家庄云摄影位于石家庄市大经街天滋嘉鲤南区8-2-501',
        /*'_image'=>array(
            (object) array('_id'=>1,
                  "_preurl"=>'http://img.pmkoo.com:9300/upload/seller/559266b8d092f.jpg',
                "_url"=>'http://img.pmkoo.com:9300/upload/seller/559266b8d092f.jpg'),
            (object) array('_id'=>2,
                "_preurl"=>'http://img.pmkoo.com:9300/upload/seller/559266b8d092f.jpg',
                "_url"=>'http://img.pmkoo.com:9300/upload/seller/559266b8d092f.jpg'),
        ),*/
        '_event'=>"10"



    );

    $data = array(

        'key' =>YUNTU_API_KEY,
        'tableid' => YUNTU_API_TABLEID,
        'loctype' =>  2,//"",
        'data'=>json_encode($store_info),
    );

    dump($data);

    $curl = new Curl();
    $curl->setHeader('Content-Type', 'application/x-www-form-urluncoded');
    //$curl->setBasicAuthentication(GRATIPAY_API_KEY);
    $curl->post(YUNTU_API_URL_PRE."/data/create" , $data);


    dump ($curl->response);



});

/*
 * 获取数据
 */

$app->get('/data/get',function () use ($app)  {

/*
    $store_info=array(
        "_name"=>'234234',
        // '_description'=>'我',
        '_location'=>'',
        '_address'=>'234234324',
        '_logo'=>'http://img.pmkoo.com:9300/upload/seller/559266b8d092f.jpg',
        '_event'=>"10"


    );*/

    $data = array(

        'key' =>YUNTU_API_KEY,
        'tableid' => YUNTU_API_TABLEID,
        'keywords' => "",
        'city'=>'石家庄',
       // 'brand_id'=>165
         'filter' =>  "brand_id:165",

    );

    dump($data);

    $curl = new Curl();
    $curl->setHeader('Content-Type', 'application/x-www-form-urluncoded');
    //$curl->setBasicAuthentication(GRATIPAY_API_KEY);
    $curl->get("http://yuntuapi.amap.com/datasearch/local" , $data);


    $response=$curl->response;

    dump($response);
    exit;
    http://yuntuapi.amap.com/datamanage/data/update
    $data = array(

        'key' =>YUNTU_API_KEY,
        'tableid' => YUNTU_API_TABLEID,
        'filter' =>  "category_1:11",

    );

    // dump($data);

    $curl = new Curl();
    $curl->setHeader('Content-Type', 'application/x-www-form-urluncoded');
    //$curl->setBasicAuthentication(GRATIPAY_API_KEY);

    for($i=300;$i<510;$i++) {
        $data = array(

            'key' => YUNTU_API_KEY,
            'tableid' => YUNTU_API_TABLEID,
            'data' => json_encode(array(
                "_id" => $i,
                // "id"=>9,
                "category_1" => 11
            ))


        );


        $curl->post("http://yuntuapi.amap.com/datamanage/data/update", $data);
    }
    dump($curl->response);
});




/*
 * 数据删除
 */

$app->get('/data/delete',function () use ($app)  {


    $ids=array();

    $curl = new Curl();
    $curl->setHeader('Content-Type', 'application/x-www-form-urluncoded');
    //$curl->setBasicAuthentication(GRATIPAY_API_KEY);
    for($i=533;$i<560;$i++){

        $data = array(

            'key' =>YUNTU_API_KEY,
            'tableid' => YUNTU_API_TABLEID,
            'ids' =>  $i

        );
        $curl->post("http://yuntuapi.amap.com/datamanage/data/delete" , $data);

    }


    dump ($curl->response);



});



$app->get('/import',function () use ($app)  {



    $res = array();
    $product = ORM::for_table('seller')->limit(10);


    $data = $product-> find_array();


    foreach($data as $k=>$v){



        $store=array();
        $store['_name']=$v["name"];
        $store['_address']="河北省石家庄市".$v["address"];
        $store['id']=$v["seller_id"];
        $store['category_1']=11;

        $store['img_1_1']=$v["logo"];
        $store['img_2_1']=$v["img_top"];
        $store['introduction']=$v["description"];
        $store['active_type']=2;


        $data = array(

            'key' =>YUNTU_API_KEY,
            'tableid' => YUNTU_API_TABLEID,
            'loctype' =>  2,//"",
            'data'=>json_encode($store),
        );



        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/x-www-form-urluncoded');
        //$curl->setBasicAuthentication(GRATIPAY_API_KEY);
        $curl->post(YUNTU_API_URL_PRE."/data/create" , $data);
echo 333;

    }





    // dump ($curl->response);



});

