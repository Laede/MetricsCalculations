<?php

namespace  Supermetrics\Tests\SupermetricsApi;

use PHPUnit\Framework\TestCase;
use Supermetrics\Http\CurlClient;
use Supermetrics\SupermetricsApi\Api;
use Supermetrics\SupermetricsApi\User;
use Supermetrics\Tools\MetricsCalculator;

/**
 * Class ApiTest.
 */
class ApiTest extends TestCase
{
    public function testApiRequest()
    {
        $client = new CurlClient(ConstParams::URL);
        $user = new User(ConstParams::CLIENT_ID,ConstParams::NAME,ConstParams::EMAIL);
        $api = new Api($client, $user);
        $calculator = new MetricsCalculator();
        $data = $api->getPosts();
        print_r($calculator->calculate($data));

    }
}