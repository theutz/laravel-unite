<?php

namespace Theutz\Unite\Concerns\Manager;

use Theutz\Unite\DTOs\Value;

/**
 * @property-write Value $value;
 */
interface ManagerInterface
{
    public function __toString(): string;
}
