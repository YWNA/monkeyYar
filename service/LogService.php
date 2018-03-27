<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-27
 * Time: 上午10:02
 */

namespace service;


class LogService
{
    public function info(){
        file_put_contents('./a.log',date('H:i:s',time()));
        return;
    }
}