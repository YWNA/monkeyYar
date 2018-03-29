<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-29
 * Time: 下午2:42
 */

if (!function_exists('env')){
    function env($key, $value_default = null){
        return \Monkey\Env::get($key, $value_default);
    }
}