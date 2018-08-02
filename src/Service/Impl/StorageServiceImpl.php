<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/8/1
 * Time: 下午6:01
 */

namespace Monkey\Service\Impl;


use Monkey\Service\Service;
use Monkey\Service\StorageService;
use Monkey\Storage\Provider;

class StorageServiceImpl extends Service implements StorageService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function upload($fileString, $bucket)
    {
        $provider = new Provider();
        $client = $provider->create('Qiniu', $bucket);
//        $client = $provider->create('Aliyun', $bucket);
        return $client->uploadBySlic(time(), $fileString);
    }
}