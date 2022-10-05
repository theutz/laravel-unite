<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;
use Brick\Math\BigNumber;

interface Parser
{
    public function parse(string $str): Value;

    public function parseUnit(string $unit): Unit;

    public function parseQuantity(BigNumber|int|float|string $quantity): BigNumber;
}
