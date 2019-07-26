<?php

namespace Supermetrics\Services;

/**
 * Class Client.
 */
class Client
{
    /**
     * @param string $url
     * @param array  $params
     * @param bool   $isPost
     *
     * @return bool|string
     */
    public function request(string $url, array $params, bool $isPost)
    {
        $ch = curl_init();
        if ($isPost) {
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POSTFIELDS => $params
            ]);
        }
        else {
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url.'?sl_token='.$params['token'].'&page='.$params['page']
            ]);
        }

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

}