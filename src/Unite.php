<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Contracts\Manager;
use Theutz\Unite\Contracts\Parser;
use Theutz\Unite\Contracts\Unite as Contract;
use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;

class Unite implements Contract
{
    public function __construct(
        private Parser $parser,
        private Manager $manager,
    ) {
    }

    public function make(
        BigNumber|float|int|string $quantity,
        Unit|string $unit
    ): Manager {
        $value = new Value(
            quantity: $this->parser->parseQuantity($quantity),
            unit: $this->parser->parseUnit($unit)
        );

        $this->manager->setValue($value);

        return $this->manager;
    }

    public function parse(string $str): Manager
    {
        $value = $this->parser->parse($str);

        return $this->make($value->quantity, $value->unit);
    }
}
