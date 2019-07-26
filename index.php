<?php

use Supermetrics\Constants\ConstParams;
use Supermetrics\Services\Client;
use Supermetrics\Tools\MetricsCalculator;
use Supermetrics\Tools\Parser;

require __DIR__.'/vendor/autoload.php';

$client = new Client();

$token = $client->request(
    ConstParams::POST_URL,
    ConstParams::$registerParams,
    true
);

$parser = new Parser();
$token = $parser->parseToken($token);

$requestCollection = $parser->collectRequest($client, $token, 10);
$dataCollection = $parser->parseRequestCollection($requestCollection);

$calculator = new MetricsCalculator();
print_r($calculator->calculate($dataCollection));



