<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-27
 * Time: 上午9:52
 */

namespace Monkey;

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Pimple\Container;

class Kernel
{
    private $container;

    public function __construct()
    {
        $this->container = new Container();
        $this->container['kernel'] = $this;
        Env::load(require_once dirname(__DIR__) . '/env.php');
    }

    function run(){
        $controller = $this->controller($_GET['controller']);
        $server = new \Yar_Server($controller);
//        $server->
        $server->handle();
    }

    private function controller($controller){
        if (!isset($this->container[$controller])){
            $this->container[$controller] = function () use ($controller) {
                $stdClass = "Monkey\\Controller\\{$controller}";
                return new $stdClass();
            };
        }
        return $this->container[$controller];
    }

}