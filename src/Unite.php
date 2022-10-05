<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Contracts\Parser;
use Theutz\Unite\Contracts\Unite as Contract;

/**
 * @property-read string $quantity
 * @property-read string $unit
 */
class Unite implements Contract
{
    private BigNumber $quantity;

    private Unit $unit;

    public function __construct(private Parser $parser)
    {
    }

    /**
     * Primary interface for object creation
     */
    public function make(BigNumber|float|int|string $quantity, Unit|string $unit): self
    {
        $unite = new self($this->parser);

        $unite->quantity = BigNumber::of($quantity);
        $unite->unit = is_string($unit) ? $this->parser->parseUnit($unit) : $unit;

        return $unite;
    }

    public function __get(string $name)
    {
        return match ($name) {
            'quantity' => (string) $this->quantity,
            'unit' => "{$this->unit->prefix?->value}{$this->unit->baseUnit->value}",
            default => null
        };
    }

    /**
     * Parses a string representation of a measurement,
     * and uses that parsed representation to instatiate.
     */
    public function parse(string $str): self
    {
        $value = $this->parser->parse($str);

        return $this->make($value->quantity, $value->unit);
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit->prefix?->value}{$this->unit->baseUnit->value}";
    }
}
