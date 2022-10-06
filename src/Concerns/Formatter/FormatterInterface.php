<?php

namespace Theutz\Unite\Concerns\Formatter;

use Theutz\Unite\Concerns\Value\ValueDto;

interface FormatterInterface
{
    public function value(ValueDto $value): string;

    public function quantity(ValueDto $value): string;

    public function unit(ValueDto $value): string;

    public function baseUnit(ValueDto $value): string;

    public function prefix(ValueDto $value): string;
}
