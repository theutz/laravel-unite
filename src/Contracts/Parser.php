<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\Value;
use Theutz\Unite\Unit;

interface Parser
{
    public function parse(string $str): Value;

    public function isUnitValid(string $str): bool;

    public function parseUnit(string $unit): Unit;
}
