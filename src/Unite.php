<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Manager\ManagerInterface;
use Theutz\Unite\Concerns\Parser\ParserInterface;
use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;

class Unite implements UniteInterface
{
    public function __construct(
        private ParserInterface $parser,
        private ManagerInterface $manager,
    ) {
    }

    public function make(
        BigNumber|float|int|string $quantity,
        Unit|string $unit
    ): ManagerInterface {
        $value = new Value(
            quantity: $this->parser->parseQuantity($quantity),
            unit: $this->parser->parseUnit($unit)
        );

        $this->manager->value = $value;

        return $this->manager;
    }

    public function parse(string $str): ManagerInterface
    {
        $value = $this->parser->parse($str);

        return $this->make($value->quantity, $value->unit);
    }
}
