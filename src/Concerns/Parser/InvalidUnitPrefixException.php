<?php

namespace Theutz\Unite\Concerns\Parser;

class InvalidUnitPrefixException extends ParseException
{
    public function __construct($unit)
    {
        parent::__construct("'$unit' has an invalid unit prefix.");
    }
}
