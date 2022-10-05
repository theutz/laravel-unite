<?php

namespace Theutz\Unite\Concerns\Formatter;

use Theutz\Unite\DTOs\Value;

class Formatter implements FormatterInterface
{
    public function value(Value $value): string
    {
        $quantity = $this->quantity($value);
        $unit = $this->unit($value);

        return "{$quantity} {$unit}";
    }

    public function quantity(Value $value): string
    {
        return (string) $value->quantity;
    }

    public function unit(Value $value): string
    {
        $prefix = $this->prefix($value);
        $baseUnit = $this->baseUnit($value);

        return "{$prefix}{$baseUnit}";
    }

    public function baseUnit(Value $value): string
    {
        return $value->unit->baseUnit->value;
    }

    public function prefix(Value $value): string
    {
        return $value->unit->prefix?->value ?? '';
    }
}
