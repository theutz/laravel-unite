<?php

namespace Theutz\Unite\Formatter;

use Theutz\Unite\Value;

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
        return $value->baseUnit->value;
    }

    public function prefix(Value $value): string
    {
        return $value->prefix?->value ?? '';
    }
}
