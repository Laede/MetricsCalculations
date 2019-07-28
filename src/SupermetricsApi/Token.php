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
     * @var User
     */
    private $user;

    /**
     * Token constructor.
     *
     * @param string $slToken
     * @param User $user
     */
    public function __construct(string $slToken, User $user)
    {
        $this->slToken = $slToken;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->user->getEmail();
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->user->getClientId();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->user->getName();
    }

    /**
     * @return string
     */
    public function getSlToken(): string
    {
        return $this->slToken;
    }
}
