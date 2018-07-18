<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-3-29
 * Time: 下午2:19
 */

return [
    'DEBUG' => true,
    'LOG_NAME' => 'rpc',
    'LOG_DIR' => __DIR__ . '/storage/logs/',
    'RPC_SERVICE_DOMAIN' => 'yar.com',
    'MAPPING' => [
        'ak' => 'AKService'
    ],
    'MYSQL' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'root',
        'db_name' => 'monkey',
        'db_name_test' => 'monkey_test'
    ],
    'REDIS' => [
        'host' => '127.0.0.1',
        'port' => 6379
    ],
    'BEANSTALKD_HOST' => '127.0.0.1'
];