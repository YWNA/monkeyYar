<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-17
 * Time: 下午7:30
 */

namespace Monkey\Service;

interface AKService
{
    public function info();

    /**
     * @return 秘钥信息
     */
    public function generate();

    public function sign($accessKey, $jsonString, $time);

    public function checkSign($accessKey, $jsonString, $time, $sign);
}