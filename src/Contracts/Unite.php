<?php

namespace Theutz\Unite\Contracts;

use Brick\Math\BigNumber;
use Theutz\Unite\Contracts\Manager;

interface Unite
{
    public function make(BigNumber|float|int|string $quantity, string $unit): Manager;

    public function parse(string $str): Manager;
}
