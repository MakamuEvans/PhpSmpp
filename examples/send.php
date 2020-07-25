<?php

use makamuevans\PhpSmpp\connections\Connection;

require '../vendor/autoload.php';

$client = new \makamuevans\PhpSmpp\SmppClient(
    "###",
    9001,
    "###",
    "###"
);
$client->openConnection(Connection::CONNECTION_RX);
do {
    $result = $client->receive();
    echo "we here........";
    //var_dump($result);
    if ($result){
        echo "we here\n\n";
        echo $result->id. "     ".$result->stat;
        echo "\ndone...\n";
    }
} while ($result);
$client->closeConnection();


