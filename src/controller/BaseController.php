<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-26
 * Time: 下午5:37
 */
namespace Monkey\Controller;
class BaseController extends \Pimple\Container
{
    protected $provider = [
        \root\LogService::class
    ];
    function __construct()
    {
        parent::__construct();
        $this->registerProvider();
    }
    private function registerProvider()
    {
        foreach ($this->provider as $provider) {
            $this->register(new $provider());
        }
    }

}