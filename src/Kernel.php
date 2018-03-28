<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-27
 * Time: 上午9:52
 */

namespace src;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/service/LogService.php';
use Pimple\Container;
use service\LogService;

class Kernel
{
    private $container;
    public function __construct()
    {
        $this->container = new Container();
        $this->container['kernel'] = $this;
    }

    function run(){
        $service = $_GET['service'];
        $service = $this->service($_GET['service']);
        $server = new \Yar_Server($service);
        $server->handle();
    }

    private function service($service){
        if (!isset($this->container[$service])){
            $this->container[$service] = function () use ($service) {
//                $stdClass = "service\\{$service}";
//                return new $stdClass;
                return new LogService();
            };
        }
        $this->container[$service]->info($service);
        return $this->container[$service];
    }
}