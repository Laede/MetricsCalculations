<?php

namespace Supermetrics\Tests\Http;

use PHPUnit\Framework\TestCase;
use Supermetrics\Http\CurlClient;
use Supermetrics\Http\RequestException;

/**
 * Class CurlClientTest.
 */
class CurlClientTest extends TestCase
{
    public function testReturnCorrectStatusCode()
    {
        $client = new CurlClient('http://this-is-a-test.test');
        try {
            $client->get('testing');
        } catch (RequestException $e) {

        }
    }

    /**
     * @expectedException \Supermetrics\Http\RequestException
     */
    public function testThrowsExceptionOnFail(): void
    {
        $client = new CurlClient('https://api.supermetrics.com/assignment');

        $client->get('/test');
    }
}