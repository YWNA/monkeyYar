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
        $log = $this->log;
        return $log->info(__CLASS__);
    }

}