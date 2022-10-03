<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;

class Unite
{
    const VALID_AMOUNT = '/^(\d+\.?\d*)\s*(\D+[2,3]?)$/';

    private BigDecimal $quantity;

    private mixed $unit;

    public function make(mixed $quantity, string $unit): self
    {
        $unite = new self;

        $unite->quantity = BigDecimal::of($quantity);
        $unite->unit = $unit;

        return $unite;
    }

    public function parse(string $str): self
    {
        $unite = new self;
        $matches = [];

        if (!preg_match(self::VALID_AMOUNT, $str, $matches)) {
            throw new Exceptions\ParseError("{$str} is not a valid input");
        }

        return $this->make($matches[1], $matches[2]);
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit}";
    }

}
