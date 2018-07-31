<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-27
 * Time: 上午9:49
 */
require_once 'src/Kernel.php';
$kernel = new \Monkey\Kernel();
try {
    $kernel->run();
} catch (Exception $exception){
    $kernel->logger->error($exception->getMessage());
}