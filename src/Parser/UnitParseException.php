<?php

namespace Theutz\Unite\Parser;

class UnitParseException extends \RuntimeException
{
    public function __construct($unit)
    {
        parent::__construct("{$unit} is an invalid unit.");
    }
}
