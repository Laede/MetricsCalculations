<?php
declare(strict_types=1);

namespace Supermetrics\SupermetricsApi;

/**
 * Class Post
 * @package Supermetrics\SupermetricsApi
 */
class Post
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $fromId;
    /**
     * @var string
     */
    private $fromName;
    /**
     * @var string
     */
    private $status;
    /**
     * @var \DateTime
     */
    private $createdTime;
    /**
     * @var string
     */
    private $message;

    /**
     * Post constructor.
     *
     * @param string    $id
     * @param string    $fromId
     * @param string    $fromName
     * @param string    $message
     * @param string    $status
     * @param \DateTime $createdTime
     */
    public function __construct(
        string $id,
        string $fromId,
        string $fromName,
        string $message,
        string $status,
        \DateTime $createdTime
    ) {
        $this->id = $id;
        $this->fromId = $fromId;
        $this->fromName = $fromName;
        $this->status = $status;
        $this->createdTime = $createdTime;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFromId(): string
    {
        return $this->fromId;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime(): \DateTime
    {
        return $this->createdTime;
    }
}