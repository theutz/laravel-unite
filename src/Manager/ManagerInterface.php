<?php

namespace Theutz\Unite\Manager;

use Theutz\Unite\Concerns\Value\ValueDto;

/**
 * @property-write ValueDto $value;
 */
interface ManagerInterface
{
    public function __toString(): string;
}
