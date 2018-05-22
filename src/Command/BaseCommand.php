<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-2
 * Time: 下午6:51
 */

namespace Monkey\Command;


use Monkey\Container;
use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    protected $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
        parent::__construct();
    }
}