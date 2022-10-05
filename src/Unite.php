<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Contracts\Parser;
use Theutz\Unite\Contracts\Unite as Contract;
use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;

/**
 * @property-read BigNumber $quantity
 * @property-read Unit $unit
 */
class Unite implements Contract
{
    private BigNumber $quantity; // @phpstan-ignore-line

    private Unit $unit; // @phpstan-ignore-line

    public function __construct(
        private Parser $parser
    ) {
    }

    public function make(BigNumber|float|int|string $quantity, Unit|string $unit): Unite
    {
        $unite = app(self::class);

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

    public function parse(string $str): Unite
    {
        $value = $this->parser->parse($str);

        return $this->make($value->quantity, $value->unit);
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit->prefix?->value}{$this->unit->baseUnit->value}";
    }
}
