<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-8
 * Time: 下午6:12
 */

namespace Monkey\Provider;
use Monkey\Service\LogService;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $name = env('LOG_NAME');
        $path = env('LOG_DIR');
        $pimple['log'] = function () {
            return new LogService();
        };
        $pimple['monolog'] = function () use ($name, $path) {
            $log = new Logger($name);
            $log->pushHandler(new StreamHandler($path.date('Y-m-d',time()).'.log',Logger::DEBUG));
            return $log;
        };
    }

}