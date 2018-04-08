<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-26
 * Time: 下午5:37
 */
namespace Monkey\Controller;

use Monkey\Provider\LogProvider;

class BaseController extends \Pimple\Container
{
    protected $providers = [
        LogProvider::class
    ];
    function __construct()
    {
        parent::__construct();
        $this->registerProviders();
    }
    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

}