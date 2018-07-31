<?php
$env = require_once 'env.php';
$url = "http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?service=ak";
$client = new Yar_Client($url);
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("ak: val"));

echo $url . "\n";

try {
    $result = $client->generate();
    var_dump($result);
}catch (Exception $e){
    echo $e->getMessage();
}