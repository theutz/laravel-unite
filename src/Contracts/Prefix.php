<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\Enums\Prefix as PrefixEnum;

interface Prefix
{
    public function type(): PrefixEnum;

    public function abbreviation(): string;

    public function exponent(): int;

    public function multiplier(): int;
}
