<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\Value;

interface Parser
{
    public function parse(string $str): Value;
    public function isUnitValid(string $str): bool;
}
