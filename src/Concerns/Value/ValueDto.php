<?php

namespace Theutz\Unite\Concerns\Value;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Unit\UnitDto;

class ValueDto
{
    public function __construct(
        public readonly BigNumber $quantity,
        public readonly UnitDto $unit
    ) {
    }
}
