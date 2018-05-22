<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-11
 * Time: 下午6:54
 */
define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
if (!function_exists('env')){
    function env($key, $default_value = null){
        $array = require ROOT_DIR . 'env.php';
        if (isset($array[$key])){
            return $array[$key];
        } else {
            if (empty($default_value)){
                throw new Exception("not exist $key in env.php");
            } else {
                return $default_value;
            }
        }
    }
}