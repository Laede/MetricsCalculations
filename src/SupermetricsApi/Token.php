<?php

declare(strict_types=1);

namespace Supermetrics\SupermetricsApi;

/**
 * Class Token.
 */
class Token
{
    /**
     * @var string
     */
    private $slToken;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $email;

    /**
     * Token constructor.
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->slToken = $array['sl_token'];
        $this->clientId = $array['client_id'];
        $this->email = $array['email'];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getSlToken(): string
    {
        return $this->slToken;
    }
}
