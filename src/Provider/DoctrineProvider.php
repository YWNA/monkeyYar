<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-28
 * Time: 下午4:05
 */

namespace Monkey\Provider;


use Doctrine\Common\Cache\RedisCache;
use Doctrine\DBAL\Configuration;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DoctrineProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $config = new Configuration();
        $pimple['config'] = $config;
        $pimple['cache'] = new RedisCache();
        $redis = new \Redis();
        $redis->connect(env('REDIS')['host'], env('REDIS')['port']);
        $pimple['cache']->setRedis($redis);
    }

}