<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-29
 * Time: 下午2:32
 */

namespace Monkey;


class Env
{
    public static function get($key, $value_default = null){
        $value = getenv($key);
        if ($value === false){
            return $value_default;
        }
        switch ($value){
            case 'true':
                return true;
            case 'false':
                return false;
            default:
                return null;
        }
    }

    public static function load(array $env_array){
        foreach ($env_array as $key => $value){
            switch ($value){
                case true:
                    $value = 'true';
                    break;
                case false:
                    $value = 'false';
                    break;
            }
            putenv("$key=$value");
        }
    }
}