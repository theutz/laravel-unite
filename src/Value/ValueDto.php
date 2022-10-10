<?php

namespace Theutz\Unite\Value;

use Brick\Math\BigNumber;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

class ValueDto
{
    public function __construct(
        public readonly BigNumber $quantity,
        public readonly ?Prefix $prefix,
        public readonly BaseUnit $baseUnit
    ) {
    }
}
