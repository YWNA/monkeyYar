<?php
$client = new Yar_Client("http://yar/rpc.php?service=LogService");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("hd1: val", "hd2: val"));
$result = $client->info('asd');
var_dump($result);
?>
