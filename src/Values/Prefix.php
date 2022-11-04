<?php

namespace Theutz\Unite\Values;

use Brick\Math\BigNumber;
use Theutz\Unite\Definitions\Prefix as Definition;

class Prefix
{
    public readonly string $symbol;

    public readonly string $name;

    public readonly BigNumber $factor;

    public function __construct(
        Definition $definition
    ) {
        $this->symbol = $definition->symbol;
        $this->name = $definition->name;
        $this->factor = BigNumber::of($definition->factor);
    }
}
