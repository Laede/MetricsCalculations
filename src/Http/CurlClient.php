<?php

namespace Supermetrics\Http;

use Supermetrics\Http\Interfaces\ClientInterface;

/**
 * Class CurlClient.
 */
class CurlClient implements ClientInterface
{
    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $uri
     * @param array  $query
     * @throws RequestException
     * @return Response
     */
    public function get(string $uri, array $query = []): Response
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->buildUrl($uri, $query),
        ]);

        return $this->exec($ch);

    }

    /**
     * @param string $uri
     * @param array  $fields
     *
     * @return mixed|Response
     * @throws RequestException
     */
    public function post(string $uri, array $fields = []): Response
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->buildUrl($uri),
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $fields
        ]);

        return $this->exec($ch);
    }

    private function getInfo($ch,$opt = null)
    {
        $args = array();
        $args[] = $ch;
        if (func_num_args()) {
            $args[] = $opt;
        }
        return curl_getinfo(...$args);
    }

    /**
     * @param string $uri
     * @param array  $query
     *
     * @return string
     */
    private function buildUrl(string $uri, array $query = []): string
    {
        return rtrim($this->baseUrl, '/').'/'.ltrim($uri, '/').'?'.http_build_query($query);
    }

    /**
     * @param $ch
     *
     * @return Response
     * @throws RequestException
     */
    private function exec($ch): Response
    {
        $response = curl_exec($ch);

        if (false === $response) {
            $error = curl_error($ch);
            curl_close($ch);

            throw new RequestException($error);
        }
        $statusCode = $this->getInfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (in_array(floor($statusCode / 100), array(4, 5))) {

            throw new RequestException($response, $statusCode);
        }

        return new Response($response);
    }
}
