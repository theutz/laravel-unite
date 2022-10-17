<?php

namespace Theutz\Unite\Parser;

class UnitParseException extends ParseException
{
    public function __construct($string)
    {
        $this->message = "{$string} has an invalid unit.";
    }
}
