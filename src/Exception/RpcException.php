<?php

namespace PsychoB\EOS\Exception;

use Throwable;

class RpcException extends \RuntimeException
{
    public function __construct(string $message, \Throwable $e, Throwable $previous = null)
    {
        parent::__construct($message, 1, $previous ?? $e);
    }
}
