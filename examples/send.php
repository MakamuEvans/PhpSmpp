<?php

use makamuevans\PhpSmpp\connections\Connection;

require '../vendor/autoload.php';

$client = new \makamuevans\PhpSmpp\PhpSmpp(
    "###",
    9001,
    "###",
    "###"
);
$client->openConnection(Connection::CONNECTION_RX);
$next = false;
do {
    $result = $client->receive();
    echo "we here........";
    //var_dump($result);
    if ($result){
        echo "we here\n\n";
        echo $result->id. "     ".$result->stat;
        echo "\ndone...\n";
        $next  = true;
    } else
        $next = false;
} while ($next);
$client->closeConnection();


