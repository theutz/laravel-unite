<?php

namespace Theutz\Unite;

class Unite
{
    private mixed $quantity;

    private mixed $unit;

    public function make(mixed $quantity, string $unit): self
    {
        $unite = new self;
        $unite->quantity = $quantity;
        $unite->unit = $unit;
        return $unite;
    }

    public function __toString():string
    {
        return "{$this->quantity} {$this->unit}";
    }
}
