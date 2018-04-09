<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-26
 * Time: 下午6:31
 */

namespace Monkey\Controller;

class IndexController extends BaseController
{
    function info($parameters){
        $this->monolog->info('test' . date('Y-m-d H:i:s',time()));
        $this->monolog->info(print_r($parameters,true));
        return __FUNCTION__;
    }

    function concurrent($parameters){
        $this->monolog->info(print_r($parameters,true));
//        throw new \Yar_Server_Exception('error');
        return __FUNCTION__;
    }
}