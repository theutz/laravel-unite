<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;

class Unite
{
    const VALID_AMOUNT = '/^(\d+\.?\d*)\s*(\D+[2,3]?)$/';

    private BigDecimal $quantity;

    private mixed $unit;

    /**
     * Primary interface for object creation
     */
    public function make(mixed $quantity, string $unit): self
    {
        $unite = new self;

        $unite->quantity = BigDecimal::of($quantity);
        $unite->unit = $unit;

        return $unite;
    }

    /**
     * Parses a string representation of a measurement,
     * and uses that parsed representation to instatiate.
     */
    public function parse(string $str): self
    {
        $unite = new self;
        $matches = [];

        if (! preg_match(self::VALID_AMOUNT, $str, $matches)) {
            throw new Exceptions\ParseError("{$str} is not a valid input");
        }

        return $this->make($matches[1], $matches[2]);
    }

    /**
     * Returns the quantity without the unit
     */
    public function quantity(): BigDecimal
    {
        return $this->quantity;
    }

    /**
     * Returns the unit without the quantity
     */
    public function unit(): mixed
    {
        return $this->unit;
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit}";
    }
}
