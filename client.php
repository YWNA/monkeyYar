<?php
$env = require_once 'env.php';
$client = new Yar_Client("http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?service=IndexController");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("hd1: val", "hd2: val"));
$result = $client->info();
var_dump($result);
?>
