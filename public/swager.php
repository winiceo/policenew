<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/10/26
 * Time: 上午10:23
 */

require("../vendor/autoload.php");
$swagger = \Swagger\scan('../app/route');
header('Content-Type: application/json');
echo $swagger;