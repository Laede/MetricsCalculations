<?php

use Supermetrics\Http\CurlClient;
use Supermetrics\SupermetricsApi\Api;
use Supermetrics\SupermetricsApi\User;
use Supermetrics\Tools\MetricsCalculator;
use Supermetrics\Tools\Parser;

require __DIR__.'/vendor/autoload.php';


$client = new CurlClient('https://api.supermetrics.com/assignment');
$user = new User(
    'ju16a6m81mhid5ue1z3v2g0uh',
    'Your Name',
    'your@email.address'
);
$api = new Api($client, $user);
$calculator = new MetricsCalculator();
$data = $api->getPosts();
print_r($calculator->calculate($data));
