<?php
$env = require_once 'env.php';
$client = new Yar_Client("http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?controller=IndexController");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("ak: val"));
$result = $client->info($parameters = ['parameters'=>'chenbo']);
var_dump($result);
?>
