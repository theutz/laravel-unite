<?php

namespace Theutz\Unite\Parser;

class PrefixParseException extends ParseException
{
    public function __construct($prefix)
    {
        $this->message = "{$prefix} has an invalid prefix.";
    }
}
