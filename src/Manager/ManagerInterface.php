<?php

namespace Theutz\Unite\Manager;

use Theutz\Unite\Value\ValueDto;

/**
 * @property-write ValueDto $value;
 */
interface ManagerInterface
{
    public function __toString(): string;
}
