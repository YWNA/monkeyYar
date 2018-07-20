<?php
$env = require_once 'env.php';
$client = new Yar_Client("http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?service=ak");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("ak: val"));
//$result = $client->info();

try {
//    $result = $client->generate();
//    var_dump($result);
//    $accessKey = $result['access_key'];
    $accessKey = 'bc904283f8da4bae8eece9f53fcd1ca7';
    $time = time();
    $result = $client->sign($accessKey, ['chenbo' => 'chenbo'], $time);
    var_dump($result);
    $result = $client->checkSign($accessKey, ['chenbo' => 'chenbo'], $time, $result);
    var_dump($result);
} catch (Exception $e){
    var_dump($e->getMessage());
}
