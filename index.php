<?php

use Supermetrics\Services\Client;

require __DIR__.'/vendor/autoload.php';


$client = new Client();

$data = $client->getData($client->registerToken());
print_r($client->test($data));

