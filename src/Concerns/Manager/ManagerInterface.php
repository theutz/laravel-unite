<?php

namespace Theutz\Unite\Concerns\Manager;

use Theutz\Unite\DTOs\Value;

interface ManagerInterface
{
    public function setValue(Value $value): void;

    public function __toString(): string;
}
