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

    public function testReturnResponseOnGoodRequest(): void
    {
        $client = new CurlClient('https://api.supermetrics.com/assignment');
        $user = new User('ju16a6m81mhid5ue1z3v2g0uh', 'Your Name', 'your@email.address');
        $response = $client->post('/register', $user->toArray());
        $this->assertNotInstanceOf( RequestException::class, $response);
    }
}
