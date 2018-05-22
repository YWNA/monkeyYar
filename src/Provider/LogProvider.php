<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-23
 * Time: 上午9:57
 */

namespace Monkey\Provider;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogProvider implements ServiceProviderInterface
{
    public function register(Container $container){
        $name = env('LOG_NAME');
        $path = env('LOG_DIR');
        $container['monolog'] = function () use ($name, $path) {
            $log = new Logger($name);
            $log->pushHandler(new StreamHandler($path.date('Y-m-d',time()).'.log',Logger::DEBUG));
            return $log;
        };
    }
}