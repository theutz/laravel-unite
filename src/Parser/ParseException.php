<?php

namespace Theutz\Unite\Parser;

class ParseException extends \RuntimeException
{
    public function __construct($string) {
        $this->message = "{$string} cannot be parsed.";
    }
}
