<?php

namespace Theutz\Unite\Concerns\Parser;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Unit\UnitDto;
use Theutz\Unite\Concerns\Value\ValueDto;

interface ParserInterface
{
    public function parse(string $str): ValueDto;

    public function parseUnit(UnitDto|string $unit): UnitDto;

    public function parseQuantity(BigNumber|int|float|string $quantity): BigNumber;
}
