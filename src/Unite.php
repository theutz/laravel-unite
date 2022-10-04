<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Exceptions\ParseException;

/**
 * @property-read string $quantity
 * @property-read string $unit
 */
class Unite
{
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
        try {
            [$quantity, $unit] = explode(' ', $str, 2);
        } catch (\Exception $e) {
            throw new ParseException('Please separate the quantity and unit with a space character.');
        }

        if (! preg_match('/^\w\D*[23]?$/', $unit)) {
            throw new ParseException('The given unit is invalid.');
        }

        try {
            return $this->make($quantity, $unit);
        } catch (\Brick\Math\Exception\NumberFormatException $e) {
            throw new ParseException($e->getMessage());
        }
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
