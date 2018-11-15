<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/11/15
 * Time: 16:30
 */

namespace Monkey\Storage;


interface Storage
{
    public function init($dir = null);

    public function uploadWithString($fileString, $name);
}