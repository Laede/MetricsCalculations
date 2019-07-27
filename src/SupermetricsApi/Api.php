<?php

declare(strict_types=1);

namespace Supermetrics\SupermetricsApi;

use Supermetrics\Http\Interfaces\ClientInterface;
use Supermetrics\Http\RequestException;

/**
 * Class Api.
 */
class Api
{
    public const TOKEN_URI = '/register';
    public const POSTS_URI = '/posts';

    /**
     * @var ClientInterface
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
     * @param ClientInterface $client
     * @param User            $user
     */
    public function __construct(ClientInterface $client, User $user)
    {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * @return array
     * @throws RequestException
     */
    public function getPosts(): array
    {
        if (null === $this->token) {
            $this->refreshToken();
        }

        $postCollection = [];
        for ($i =1; $i <= 10; $i++) {
            $postCollection[] = $this->client->get(
                self::POSTS_URI,
                [
                    'sl_token' => $this->token->getSlToken(),
                    'page' => $i,
                ]
            )->data()['posts'];
        }

        return array_merge(...$postCollection);
    }

    /**
     * @return Token
     * @throws RequestException
     */
    private function refreshToken(): void
    {
        $tokenResponse = $this->client->post(self::TOKEN_URI, [
            'client_id' => $this->user->getClientId(),
            'email' => $this->user->getEmail(),
            'name' => $this->user->getName(),
        ]);

        $this->token =  new Token($tokenResponse->data());

    }
}
