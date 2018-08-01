<?php
$env = require_once '../env.php';
$url = "http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?service=storage";
$client = new Yar_Client($url);
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("bucket: book"));

echo $url . "\n";

try {
    $file = file_get_contents(__DIR__.'/test.png');
    $result = $client->upload($file, 'book');
    var_dump($result);
}catch (Exception $e){
    echo $e->getMessage();
}