<?php

namespace Theutz\Unite\Parser;

class QuantityParseException extends \RuntimeException
{
    public function __construct($quantity)
    {
        parent::__construct("{$quantity} is an invalid quantity.");
    }
}
