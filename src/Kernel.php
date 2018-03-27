<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-27
 * Time: 上午9:52
 */

namespace src;
require_once '../vendor/autoload.php';

use Pimple\Container;
class Kernel
{
    private $container;
    public function __construct()
    {
        $this->container = new Container();
        $this->container['kernel'] = $this;
    }

    function run(){
        $service = $this->service($_GET['service']);
        $server = new Yar_Server($service);
        $server->handle();
    }

    private function service($service){
        if (!isset($this->container[$service])){
            $this->container[$service] = function () use ($service) {
                return new $service;
            };
        }
        return $this->container[$service];
    }
}