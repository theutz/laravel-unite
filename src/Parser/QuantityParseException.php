<?php

namespace Theutz\Unite\Parser;

class QuantityParseException extends ParseException
{
    public function __construct($quantity)
    {
        $this->message = "{$quantity} has an invalid quantity.";
    }
}
