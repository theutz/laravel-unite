<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Manager\ManagerInterface;

interface UniteInterface
{
    public function make(BigNumber|float|int|string $quantity, string $unit): ManagerInterface;

    public function parse(string $str): ManagerInterface;
}
