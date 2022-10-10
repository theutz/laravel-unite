<?php

namespace Theutz\Unite\Parser;

class InvalidQuantityException extends ParseException
{
    public function __construct($quantity)
    {
        parent::__construct("'$quantity' is not a valid quantity.");
    }
}
