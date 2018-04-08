<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-8
 * Time: 下午6:12
 */

namespace Monkey\Provider;
use Monkey\Service\LogService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['log'] = function () {
            return new LogService();
        };
    }

}