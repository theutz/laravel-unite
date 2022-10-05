<?php

namespace Theutz\Unite\Concerns\Parser;

class InvalidQuantityException extends ParseException
{
    public function __construct($quantity)
    {
        parent::__construct("'$quantity' is not a valid quantity.");
    }
}
