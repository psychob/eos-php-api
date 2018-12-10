<?php

namespace PsychoB\EOS\Exception;

class KeyNotFoundException extends \RuntimeException
{
    public function __construct(string $id, array $possible, \Throwable $previous = null)
    {
        parent::__construct(sprintf("Not found key: %s in %s", $id, implode(', ', $possible)), 0, $previous);
    }
}
