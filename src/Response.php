<?php
/**
 * Created by PhpStorm.
 * User: chenbotome@163.com
 * Date: 2018/7/20
 * Time: 下午3:50
 */

namespace Monkey;


class Response
{
    static private $version = '0.1';

    static public function success(array $data, string $msg = ''): string {
        return self::response($data, $msg, 200);
    }

    static private function response(array $data, string $msg, int $code): string {
        return json_encode([
            'version' => self::$version,
            'result' => [
                'data' => $data,
                'code' => $code,
                'msg' => $msg
            ]
        ],JSON_NUMERIC_CHECK);
    }
}