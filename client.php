<?php
$env = require_once 'env.php';
$client = new Yar_Client("http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?service=ak");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("ak: val"));
//$result = $client->info();
$result = $client->generate();
$accessKey = $result['access_key'];
$time = time();
$result = $client->sign($accessKey, ['chenbo'=>'chenbo'], $time);
var_dump($result);
$result = $client->checkSign($accessKey, ['chenbo'=>'chenbo'], $time, $result);
var_dump($result);
