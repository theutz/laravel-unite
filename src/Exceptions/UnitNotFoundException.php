<?php

namespace Theutz\Unite\Exceptions;

use RuntimeException;

class UnitNotFoundException extends RuntimeException
{
    public function __construct(string $unit)
    {
        parent::__construct("'{$unit}' is not a known unit of measure.");
    }
}
