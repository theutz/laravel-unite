<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;

interface Parser
{
    public function parse(string $str): Value;

    public function parseUnit(string $unit): Unit;
}
