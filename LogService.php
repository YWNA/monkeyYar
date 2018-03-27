<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-26
 * Time: 下午2:53
 */
namespace root;
class LogService
{
    public function info($msg){
        file_put_contents('./a.log',$msg);
        return;
    }
}