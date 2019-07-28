<?php

declare(strict_types=1);

namespace Supermetrics\SupermetricsApi;

use Supermetrics\Http\Interfaces\Client;
use Supermetrics\Http\RequestException;

/**
 * Class Api.
 */
class ApiClient
{
    public const TOKEN_URI = '/register';
    public const POSTS_URI = '/posts';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Token
     */
    private $token;
    /**
     * @var User
     */
    private $user;

    /**
     * Api constructor.
     *
     * @param Client $client
     * @param User            $user
     */
    public function __construct(Client $client, User $user)
    {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * @return Post[]
     * @throws RequestException
     */
    public function getPosts(): array
    {
        if (null === $this->token) {
            $this->refreshToken();
        }

        $posts = [];

        /**
         * Api doesn't return next page url or any
         * other indicator that there other pages exists
         * so the only thing we can do - fetch everything
         * in a single loop
         */
        for ($i =1; $i <= 10; $i++) {
            $response = $this->client->get(
                self::POSTS_URI,
                [
                    'sl_token' => $this->token->getSlToken(),
                    'page' => $i,
                ]
            )->data();

            /**
             * It's not necessary to rebuild each post to new PHP object,
             * but type hinting in constructor allows to prevent null in case
             * if keys or values will be changed in api
             */
            foreach ($response['posts'] as $post) {
                $posts[] = new Post(
                    $post['id'],
                    $post['from_id'],
                    $post['from_name'],
                    $post['message'],
                    $post['type'],
                    new \DateTime($post['created_time'])
                );
            }
        }

        return $posts;
    }

    /**
     * @return Token
     * @throws RequestException
     */
    private function refreshToken(): void
    {
        $tokenResponse = $this->client->post(self::TOKEN_URI, $this->user->toArray());
        $this->token =  new Token($tokenResponse->data()['sl_token'], $this->user);
    }
}
