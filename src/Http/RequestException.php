<?php

declare(strict_types=1);

namespace Supermetrics\Http;

use Exception;
use Throwable;

/**
 * Class RequestException.
 */
class RequestException extends Exception
{
    /**
     * RequestException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}