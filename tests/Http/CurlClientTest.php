<?php

namespace Supermetrics\Tests\Http;

use PHPUnit\Framework\TestCase;
use Supermetrics\Http\CurlClient;
use Supermetrics\Http\RequestException;
use Supermetrics\SupermetricsApi\ApiClient;
use Supermetrics\SupermetricsApi\User;

/**
 * Class CurlClientTest.
 */
class CurlClientTest extends TestCase
{
    public function testCheckIfBadIdReturns500ErrorOnTokenRequest(): void
    {
        $statusCode = 500;
        $client = new CurlClient('https://api.supermetrics.com/assignment');
        $user = new User('testIdm81mhid5ue1z3v2g0uh', 'Test Test', 'test@test.test');

        try {
            $client->post('/test', $user->toArray());
        } catch (RequestException $e) {
           $this->assertSame($statusCode, $e->getCode());
        }
    }
}
