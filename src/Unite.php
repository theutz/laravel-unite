<?php

namespace Theutz\Unite;

class Unite
{
    const VALID_AMOUNT = '/^(\d+\.?\d*)\s*(\D+[2,3]?)$/';

    private mixed $quantity;

    private mixed $unit;

    public function make(mixed $quantity, string $unit): self
    {
        $unite = new self;

        $unite->quantity = $quantity;
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

        $unite->quantity = $matches[1];
        $unite->unit = $matches[2];

        return $unite;
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit}";
    }
}
