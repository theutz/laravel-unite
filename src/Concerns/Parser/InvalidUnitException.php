<?php

namespace Theutz\Unite\Concerns\Parser;

class InvalidUnitException extends ParseException
{
    public function __construct($unit)
    {
        $message = "'$unit' is not a valid unit.";
        parent::__construct($message);
    }
}
