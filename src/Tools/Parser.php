<?php


namespace Supermetrics\Tools;


use Supermetrics\Constants\ConstParams;
use Supermetrics\Services\Client;

/**
 * Class Parser.
 */
class Parser
{
    /**
     * @param $request
     *
     * @return mixed
     */
    public function parseToken($request)
    {
        $token = $this->decode($request);

        return $token['data']['sl_token'];
    }

    /**
     * @param Client $client
     * @param string $token
     * @param int    $page
     *
     * @return array
     */
    public function collectRequest(Client $client, string $token, int $page): array
    {
        $requestCollection = [];
        for ($i =1; $i <= $page; $i++) {
            $requestCollection[] = $client->request(
                ConstParams::GET_URL,
                [
                    'token' => $token,
                    'page' => $i,
                ],
                false
            );
        }

        return $requestCollection;

    }

    /**
     * @param array $requestCollection
     *
     * @return array
     */
    public function parseRequestCollection(array $requestCollection): array
    {
        $dataCollection = [];
        foreach ($requestCollection as $item) {
            $parsedItem = $this->decode($item);

            $dataCollection[] = $parsedItem['data']['posts'];
        }

        return array_merge(...$dataCollection);
    }

    /**
     * @param $request
     *
     * @return array
     */
    private function decode($request): array
    {
        return json_decode($request, true);
    }
}