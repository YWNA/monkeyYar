<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-26
 * Time: 下午5:41
 */

class LogServiceProvider implements \Pimple\ServiceProviderInterface
{
    public function register(\Pimple\Container $pimple)
    {
        $container['log'] = function () {
            return new \Monkey\Service\LogService();
        };
    }
}