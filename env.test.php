<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-11
 * Time: 下午6:48
 */
return [
    'DEBUG' => true,
    'LOG_NAME' => 'rpc',
    'LOG_DIR' => __DIR__ . '/storage/logs/',
    'RPC_SERVICE_DOMAIN' => 'yarak',
    'MAPPING' => [
        'ak' => 'AKService',
        'storage' => 'StorageService'
    ],
    'MYSQL' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'root',
        'db_name' => 'monkey_test'
    ],
    'REDIS' => [
        'host' => '127.0.0.1'
    ]
];