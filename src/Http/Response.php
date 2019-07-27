<?php

declare(strict_types=1);

namespace Supermetrics\Http;

/**
 * Class Response.
 */
class Response
{
    /**
     * @var string
     */
    private $data;

    /**
     * Response constructor.
     *
     * @param string $data
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function rawBody() : string
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function data() : array
    {
        return json_decode($this->data, true)['data'];
    }

    /**
     * @return array
     */
    public function meta() : array
    {
        return json_decode($this->data, true)['meta'];
    }
}
