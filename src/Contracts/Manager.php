<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\DTOs\Value;

interface Manager
{
    public function setValue(Value $value): void;
    public function __toString(): string;
}
