<?php

namespace Theutz\Unite\Exceptions;

use RuntimeException;

class ConversionNotAvailableException extends RuntimeException
{
    public function __construct(string $from, string $to)
    {
        parent::__construct("A conversion from '{$from}' to '{$to}' has not been defined.");
    }
}
