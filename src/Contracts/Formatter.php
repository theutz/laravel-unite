<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\DTOs\Value;

interface Formatter
{
    public function value(Value $value): string;

    public function quantity(Value $value): string;

    public function unit(Value $value): string;

    public function baseUnit(Value $value): string;

    public function prefix(Value $value): string;
}
