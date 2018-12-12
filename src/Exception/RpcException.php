<?php

namespace PsychoB\EOS\Exception;

use GuzzleHttp\Exception\GuzzleException;
use Throwable;

class RpcException extends \RuntimeException
{
    public function __construct(string $message, GuzzleException $e, Throwable $previous = null)
    {
        parent::__construct($message, 1, $previous ?? $e);
    }
}
