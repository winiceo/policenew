<?php
/**
 * Created by PhpStorm.
 * User: leven
 * Date: 15/7/7
 * Time: 下午7:34
 */


function dump($var, $echo = true, $label = null, $strict = true)
{
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . " : " . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>'
                . $label
                . htmlspecialchars($output, ENT_QUOTES)
                . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else {
        return $output;
    }
}
// 设置 配置文件;
function C($key = NULL, $value = NULL)
{
    static $_config = array();
    //如果是数组,写入配置数组,以全字母大写的形式返回;
    if (is_array($key)) {
        return $_config = array_merge($_config, array_change_key_case($key, CASE_UPPER));
    }
    $key = strtoupper($key);
    if (!is_null($value)) {
        return $_config[$key] = $value;
    }
    if (empty($key)) {
        return $_config;
    }
    return isset($_config[$key]) ? $_config[$key] : NULL;
}

function redirect($url, $type = 1)
{
    switch ($type) {
        case 1:
            header("Location: " . $url);
            break;
        case 2:
            echo '<script>window.location.href="' . addslashes($url) . '";</script>';
            break;
        default:
            break;
    }
    exit;
}