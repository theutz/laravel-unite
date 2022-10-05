<?php

namespace Theutz\Unite\DTOs;

use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

class Unit
{
    public function __construct(
        public readonly ?Prefix $prefix,
        public readonly BaseUnit $baseUnit
    ) {
    }
}
