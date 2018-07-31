<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-17
 * Time: 下午7:28
 */

namespace Monkey;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class Kernel extends Container
{
    public function run(){
        $stdClass = $this->getStdClass($_GET);
        $server = new \Yar_Server(new $stdClass);
        $server->handle();
    }

    private function getStdClass($globalGet){
        if (!isset($globalGet['service']) || empty($service = $globalGet['service'])){
            throw new \Exception('缺少service参数');
        }
        $className = $this->getClassName($service);
        if (!class_exists($stdClass = "\\Monkey\\Service\\Impl\\{$className}Impl")){
            throw new \Exception("类{$className}Impl不存在");
        }
        return $stdClass;
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