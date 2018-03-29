<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-28
 * Time: 下午5:48
 */

namespace Monkey\Service;


use Pimple\Container;

class Service extends Container
{
    private $container;
    public function __construct()
    {
        parent::__construct();
    }
}