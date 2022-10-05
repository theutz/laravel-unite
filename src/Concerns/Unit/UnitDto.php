<?php

namespace Theutz\Unite\Concerns\Unit;

use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

class UnitDto
{
    public function __construct(
        public readonly ?Prefix $prefix,
        public readonly BaseUnit $baseUnit
    ) {
    }
}
