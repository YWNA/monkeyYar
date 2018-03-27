<?php
require 'vendor/autoload.php';
require './LogService.php';
use Pimple\Container;
class API {
    public function rpc($className, $functionName){
        $container = new Container();
        $container[$className] = function () use($className){
            $stdClass = 'root\\'.$className;
            return new $stdClass;
        };
        $test = $container[$className];
        $test->$functionName(date('H:i:s',time()) . \root\LogService::class);
    }
}

$service = new Yar_Server(new API());
$service->handle();
?>
