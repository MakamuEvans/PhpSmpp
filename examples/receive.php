<?php

use makamuevans\PhpSmpp\connections\Connection;

require '../vendor/autoload.php';

$client = new \makamuevans\PhpSmpp\SmppClient(
    "messaging.airtelkenya.com",
    9001,
    "bongatechT",
    "Ecp@4321"
);
$client->openConnection(Connection::CONNECTION_RX);
//$client->transmit("22847_NTSA", "254737942177", "hahahaha");
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


