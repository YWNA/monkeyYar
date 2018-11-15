<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/8/1
 * Time: 下午5:54
 */

namespace Monkey\Service;


interface StorageService
{
    public function upload($fileString, $bucket);

    public function test();
}