<?php

namespace Theutz\Unite\Contracts;

use Brick\Math\BigNumber;

interface Unite
{
    public function make(BigNumber|float|int|string $quantity, string $unit): self;

    public function parse(string $str): self;
}
