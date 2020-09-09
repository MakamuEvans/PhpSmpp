<?php

use makamuevans\PhpSmpp\connections\Connection;

require '../vendor/autoload.php';

$client = new \makamuevans\PhpSmpp\SmppClient(
    'host', //replace with valid data
    'port', //replace with valid data
    'username', //replace with valid data
    'pass' //replace with valid data
);
$client->openConnection(Connection::CONNECTION_RX);
do {
    $result = $client->receive();
    echo "we here........";
    if ($result){
        echo "we here\n\n";
        echo $result->id. "     ".$result->stat;
        echo "\ndone...\n";
    }
} while ($result);
$client->closeConnection();


