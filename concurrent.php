<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-9
 * Time: 下午5:34
 */
function callback($retval, $callinfo) {
    var_dump("回调函数打印信息".print_r($retval, true));
}

function error_callback($type, $error, $callinfo) {
    var_dump($error);
}
$env = require_once 'env.php';
$url = "http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?controller=IndexController";
Yar_Concurrent_Client::call($url, "concurrent", array('chenboA1', 'chenboB1'), "callback");
Yar_Concurrent_Client::call($url, "concurrent", array('chenbo2'));
Yar_Concurrent_Client::call($url, "concurrent", array('chenbo3'), "callback", "error_callback", array(YAR_OPT_PACKAGER => "json"));
Yar_Concurrent_Client::call($url, "concurrent", array('chenbo4'), "callback", "error_callback", array(YAR_OPT_TIMEOUT=>1));
Yar_Concurrent_Client::loop("callback", "error_callback"); //send the requests,the error_callback is optional
?>