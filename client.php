<?php
$client = new Yar_Client("http://yar-test.dev/rpc.php");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);
$client->SetOpt(YAR_OPT_HEADER, array("hd1: val", "hd2: val"));
$result = $client->rpc('LogService','info');
?>
