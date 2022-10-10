<?php

namespace Theutz\Unite\Formatter;

use Theutz\Unite\Value\ValueDto;

class Formatter implements FormatterInterface
{
    public function value(ValueDto $value): string
    {
        $quantity = $this->quantity($value);
        $unit = $this->unit($value);

        return "{$quantity} {$unit}";
    }

    public function quantity(ValueDto $value): string
    {
        return (string) $value->quantity;
    }

    public function unit(ValueDto $value): string
    {
        $prefix = $this->prefix($value);
        $baseUnit = $this->baseUnit($value);

        return "{$prefix}{$baseUnit}";
    }

    public function baseUnit(ValueDto $value): string
    {
        return $value->baseUnit->value;
    }

    public function prefix(ValueDto $value): string
    {
        return $value->prefix?->value ?? '';
    }
}
