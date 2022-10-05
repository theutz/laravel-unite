<?php

namespace Theutz\Unite\DTOs;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Unit\UnitDto;

class Value
{
    public function __construct(
        public readonly BigNumber $quantity,
        public readonly UnitDto $unit
    ) {
    }
}
