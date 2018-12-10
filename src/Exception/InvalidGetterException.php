<?php

namespace PsychoB\EOS\Exception;

use Throwable;

class InvalidGetterException extends \RuntimeException
{
    public function __construct(string $name, Throwable $previous = null)
    {
        parent::__construct(sprintf("Property not found: %s", $name), 1, $previous);
    }
}
