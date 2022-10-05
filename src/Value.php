<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;

class Value
{
    public function __construct(
        public readonly BigNumber $quantity,
        public readonly Unit $unit
    ) {
    }
}
