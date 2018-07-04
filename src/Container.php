<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-2
 * Time: 下午6:43
 */

namespace Monkey;


use Monkey\Provider\DoctrineProvider;
use Monkey\Provider\LogProvider;

class Container extends \Pimple\Container
{
    protected $providers = [
        LogProvider::class,
        DoctrineProvider::class
    ];
    public function __construct()
    {
        parent::__construct();
        $this->registerProviders();
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id,$value);
    }

    private function registerProviders(){
        foreach ($this->providers as $provider){
            $this->register(new $provider);
        }
        if (getenv('isTest')){
            $this->isTest = getenv('isTest');
        } else {
            $this->isTest = false;
        }
    }
}