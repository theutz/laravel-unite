<?php

namespace Theutz\Unite\Contracts;

use Brick\Math\BigNumber;
use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;

interface Parser
{
    public function parse(string $str): Value;

    public function parseUnit(Unit|string $unit): Unit;

    public function parseQuantity(BigNumber|int|float|string $quantity): BigNumber;
}
