<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/10/16
 * Time: 11:58
 */

namespace Monkey\Storage;


class StorageFactory
{
    public function create($name){
        $stdClass = __NAMESPACE__ . "\\Storage$name";
        return new $stdClass;
    }
}