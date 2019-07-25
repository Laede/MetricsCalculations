<?php

namespace Supermetrics\Services;
use Supermetrics\Constants\ConstParams;
use Supermetrics\Tools\DataIterator;

/**
 * Class Client.
 */
class Client
{
    use DataIterator;

    /**
     * @var string
     */
    private $url;
    /**
     * @var array
     */
    private $params;


    public function __construct()
    {
        $this->url = ConstParams::POST_URL;
        $this->params = [
            'client_id' => ConstParams::CLIENT_ID,
            'name' => ConstParams::NAME,
            'email' => ConstParams::EMAIL
        ];
    }

    /**
     * @return string
     */
    public function registerToken(): string
    {
        $ch = curl_init($this->url);

        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $this->params
        ]);

        $data = json_decode(curl_exec($ch), true);

        curl_close($ch);


        return $data['data']['sl_token'];

    }

    /**
     * @param string $token
     * @param int    $page
     *
     * @return array
     */
    public function getData(string $token): array
    {
        return $this->collectData($token);
    }

    public function test($collection)
    {
        return $this->dateAnalysis($collection);
    }

}