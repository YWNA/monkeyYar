<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/11/15
 * Time: 16:28
 */

namespace Monkey\Storage;


class Provider
{
    public function create($provider){
        $provider = ucfirst($provider);
        $stdClass = __NAMESPACE__ . "\\Storage$provider";
        return new $stdClass;
    }
}