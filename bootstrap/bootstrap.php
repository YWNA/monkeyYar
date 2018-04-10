<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-26
 * Time: 下午3:04
 */
require_once dirname(__DIR__) . '/src/Kernel.php';
define('ROOT_DIR', dirname(__DIR__));
$kernel = new Monkey\Kernel();
return $kernel;