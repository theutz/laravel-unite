<?php

namespace Theutz\Unite\Manager;

use Theutz\Unite\Value;

/**
 * @property-write Value $value;
 */
interface ManagerInterface
{
    public function __toString(): string;
}
