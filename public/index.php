<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/10/25
 * Time: 下午10:52
 */

ignore_user_abort(TRUE);
set_time_limit(0);
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin:*");
define('_ACCESS_FILE', 'true');


header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description ,Authorization,X-File-Name,x-requested-with');

define('ROOT', dirname(__DIR__) . "/");

require ROOT . 'vendor/autoload.php';

require ROOT . 'app/lib/function.php';

require ROOT . 'app/lib/SlimSwagger.php';
C(require(ROOT . 'app/config/config.php'));

foreach (C('define') as $key => $value) {
    define($key, $value);
};
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);


// Get DI Container
$container = $app->getContainer();

// Register Twig View service
$container->register(new \Slim\Views\Twig(ROOT . 'app/views', [

]));
$options = array(
    'baseDir' => ROOT . 'app/route',
    'ignoreDir' => array()
);

$swaggerSettings = array(
    'output' => 'json',
    'apiVersion' => 'v1',
    'swaggerVersion' => 'v2',

);


$app->group('/v1/{controller}', function () use ($app) {

    $uri = $app->request->getUri();
    //dump($uri);
    $path = $uri->getPath();
    //Handle  /api/getitems/seafood//fruit////meat
    if (strpos($path, '//') !== false) {
        $path = preg_replace("#//+#", "/", $path);
    }

    //Remove the last slash
    if (substr($path, -1) === '/') {
        $path = substr($path, 0, strlen($path) - 1);
    }


    //explode or create array depending if there are 1 or many parameters
    if (strpos($path, '/') !== false) {

        $values = explode('/', $path);

    } else {

        $values = array($path);
    }

   // dump($values);
    if (count($values) >= 2) {
        $route = $values[2];
        $fileName = ROOT . "app/route/" . $route . ".php";

        if (file_exists($fileName)) {
            require $fileName;
        }
    }


})->add(function ($request, $response, $next) {

    //$response->write('BEFORE');
    $response = $next($request, $response);
    //  $response->write('AFTER');

    return $response;
});


$app->run();