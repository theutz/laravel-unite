<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

class Value
{
    public function __construct(
        public readonly BigNumber $quantity,
        public readonly ?Prefix $prefix,
        public readonly BaseUnit $baseUnit
    ) {
    }
}
