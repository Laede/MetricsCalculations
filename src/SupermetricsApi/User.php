<?php

declare(strict_types=1);

namespace Supermetrics\SupermetricsApi;

/**
 * Class User.
 */
class User
{
    /**
     * @var string
     */
    private $clientId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;

    /**
     * User constructor.
     *
     * @param string $clientId
     * @param string $name
     * @param string $email
     */
    public function __construct(string $clientId, string $name, string $email)
    {

        $this->clientId = $clientId;
        $this->name = $name;
        $this->email = $email;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

}