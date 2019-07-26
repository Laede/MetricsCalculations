<?php

namespace Supermetrics\Services;

use Supermetrics\Constants\ConstParams;

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
            $urlParams = http_build_query([
                ConstParams::SL_TOKEN => $params['token'],
                ConstParams::PAGE => $params['page'],
            ]);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url.$urlParams
            ]);
        }

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

}