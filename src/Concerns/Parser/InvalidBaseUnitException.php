<?php

namespace Theutz\Unite\Concerns\Parser;

class InvalidBaseUnitException extends ParseException
{
    public function __construct($unit)
    {
        parent::__construct("'$unit' has an invalid base unit.");
    }
}
