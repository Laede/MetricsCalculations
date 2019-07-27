<?php

declare(strict_types=1);

namespace Supermetrics\Http\Interfaces;

use Supermetrics\Http\RequestException;
use Supermetrics\Http\Response;

interface ClientInterface
{
    /**
     * @param string $uri
     * @param array  $query
     * @throws RequestException
     * @return Response
     */
    public function get(string $uri, array $query = []) : Response;

    /**
     * @param string $uri
     * @param array  $fields
     * @throws RequestException
     * @return Response
     */
    public function post(string $uri, array $fields= []) : Response;
}
