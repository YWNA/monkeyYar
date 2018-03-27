<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-27
 * Time: 上午9:49
 */

require_once 'vendor/autoload.php';
use src\Kernel;
$kernel = new Kernel();
//return $kernel;
//$kernel = require 'bootstrap/bootstrap.php';
$kernel->run();