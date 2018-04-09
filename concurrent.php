<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-9
 * Time: 下午5:34
 */
function callback($retval, $callinfo) {
//    var_dump("回调函数打印信息{$retval}");
    var_dump("回调函数打印信息".print_r($callinfo, true));
}

function error_callback($type, $error, $callinfo) {
    var_dump($error);
}
$env = require_once 'env.php';
$url = "http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?controller=IndexController";
$ret = Yar_Concurrent_Client::call($url, "concurrent", array("parameters"), "callback");
var_dump($ret);
$ret = Yar_Concurrent_Client::call($url, "concurrent", array("parameters"));   // if the callback is not specificed,
var_dump($ret);
                                                                               // callback in loop will be used
Yar_Concurrent_Client::call($url, "concurrent", array("parameters"), "callback", "error_callback", array(YAR_OPT_PACKAGER => "json"));
                                                                               //this server accept json packager
Yar_Concurrent_Client::call($url, "concurrent", array("parameters"), "callback", "error_callback", array(YAR_OPT_TIMEOUT=>1));
                                                                               //custom timeout

Yar_Concurrent_Client::loop("callback", "error_callback"); //send the requests,
                                                           //the error_callback is optional
?>