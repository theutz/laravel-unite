<?php

namespace Theutz\Unite\Concerns\Parser;

class InvalidQuantityException extends ParseException
{
    public function __construct($quantity)
    {
        $message = "'$quantity' is not a valid quantity.";
        parent::__construct($message);
    }
}
