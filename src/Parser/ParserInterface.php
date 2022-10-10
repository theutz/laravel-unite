<?php

namespace Theutz\Unite\Parser;

use Brick\Math\BigNumber;
use Theutz\Unite\Value\ValueDto;

interface ParserInterface
{
    public function parse(string $str): ValueDto;

    /**
     * @return array{0: ?\Theutz\Unite\Enums\Prefix, 1: \Theutz\Unite\Enums\BaseUnit}
     */
    public function parseUnit(string $unit): array;

    public function parseQuantity(BigNumber|int|float|string $quantity): BigNumber;
}
