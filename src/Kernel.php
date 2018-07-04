<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-17
 * Time: 下午7:28
 */

namespace Monkey;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class Kernel
{
    public function run(){
        if (empty($service = $_GET['service'])){
            throw new \Exception('缺少Service参数');
        }
        $className = $this->getClassName($service);
        $stdClass = "\\Monkey\\Service\\Impl\\{$className}Impl";
        $instance = new $stdClass;
        $server = new \Yar_Server($instance);
        $server->handle();
    }

    private function getClassName($service){
        $mapping = env('MAPPING');
        if (isset($mapping[$service])){
            return $mapping[$service];
        } else {
            throw new \Exception('不存在mapping关系');
        }
    }
}