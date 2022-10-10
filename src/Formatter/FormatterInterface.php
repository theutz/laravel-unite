<?php

namespace Theutz\Unite\Formatter;

use Theutz\Unite\Value;

interface FormatterInterface
{
    public function value(Value $value): string;

    public function quantity(Value $value): string;

    public function unit(Value $value): string;

    public function baseUnit(Value $value): string;

    public function prefix(Value $value): string;
}
