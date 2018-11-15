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
    'RPC_SERVICE_DOMAIN' => 'ysasaarak',
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
    ],
    'storage' => [
        'aliyun' => [
            'access_key_id' => 'LTAIp5HKgzDo4dmO',
            'access_key_secret' => '9g044cBB7s0CbHdYWH2xcH45zAbDsC',
            'endpoint' => 'oss-cn-hangzhou.aliyuncs.com',
            'bucket' => 'cn-book',
            'dir' => 'testo',
            'access_ttl' => 3600,
            'callback_url' => '',
        ]
    ]
];