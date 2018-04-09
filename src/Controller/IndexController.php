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
    function info(){
        $this->monolog->info('test' . date('Y-m-d H:i:s',time()));
        return __FUNCTION__;
    }

}