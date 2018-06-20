<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-6-7
 * Time: 上午10:39
 */

namespace Monkey\Worker;


use SWBT\Code;
use SWBT\Worker\BaseWorker;
use SWBT\Worker\Worker;

class TestWorker extends BaseWorker implements Worker
{
    public function handleJob()
    {
        var_dump('chenbo------------------------');
        return ['code'=>Code::$success];
//        return ['code'=>Code::$delayed];
//        return ['code'=>Code::$buried];
    }
}