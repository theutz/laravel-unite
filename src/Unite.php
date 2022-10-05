<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Contracts\Formatter;
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
    private Value $value;

    public function __construct(
        private Parser $parser,
        private Formatter $formatter
    ) {
    }

    public function make(
        BigNumber|float|int|string $quantity,
        Unit|string $unit
    ): Unite {
        $unite = app(self::class);

        $unite->value = new Value(
            quantity: $this->parser->parseQuantity($quantity),
            unit: $this->parser->parseUnit($unit)
        );

        return $unite;
    }

    public function __get(string $name)
    {
        return match ($name) {
            'quantity' => (string) $this->value->quantity,
            'unit' => "{$this->value->unit->prefix?->value}{$this->value->unit->baseUnit->value}",
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
        return "{$this->quantity} {$this->value->unit->prefix?->value}{$this->value->unit->baseUnit->value}";
    }
}
