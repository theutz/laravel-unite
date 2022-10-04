<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;

/**
 * @property-read string $quantity
 * @property-read string $unit
 */
class Unite
{
    const VALID_AMOUNT = '/^(\d+\.?\d*?[eE]?\d*)\s*(\D+[2,3]?)$/';

    private BigNumber $quantity;

    private mixed $unit;

    /**
     * Primary interface for object creation
     */
    public function make(BigNumber|float|int|string $quantity, string $unit): self
    {
        $unite = new self;

        $unite->quantity = BigNumber::of($quantity);
        $unite->unit = $unit;

        return $unite;
    }

    /**
     * Parses a string representation of a measurement,
     * and uses that parsed representation to instatiate.
     */
    public function parse(string $str): self
    {
        $matches = [];

        if (! preg_match(self::VALID_AMOUNT, $str, $matches)) {
            throw new Exceptions\ParseError("{$str} is not a valid input");
        }

        return $this->make($matches[1], $matches[2]);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'quantity' => (string) $this->quantity,
            'unit' => $this->unit,
            default => null
        };
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit}";
    }
}
