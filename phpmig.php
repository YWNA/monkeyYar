<?php

use Pimple\Container;
if (getenv('IN_TESTING') === 'true'){
    $env = require_once './env.test.php';
} else {
    $env = require_once './env.php';
}
$container = new Container();
$container['db'] = function () use($env) {
    $dbh = new PDO("mysql:dbname={$env['MYSQL']['db_name']};host={$env['MYSQL']['host']}",$env['MYSQL']['username'],$env['MYSQL']['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};
$container['phpmig.adapter'] = function ($c){
    return new Phpmig\Adapter\PDO\Sql($c['db'], 'migrations');
};
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';
return $container;