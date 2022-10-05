<?php

namespace Theutz\Unite\Concerns\Parser;

use Brick\Math\BigNumber;
use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;

interface ParserInterface
{
    public function parse(string $str): Value;

    public function parseUnit(Unit|string $unit): Unit;

    public function parseQuantity(BigNumber|int|float|string $quantity): BigNumber;
}
