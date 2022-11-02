<?php

namespace Theutz\Unite\Exceptions;

use RuntimeException;

class InvalidConfigException extends RuntimeException
{
    public function __construct($configKey, ...$args)
    {
        $message = "'{$configKey}' is invalid.";
        parent::__construct($message, ...$args);
    }
}
