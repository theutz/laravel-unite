<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Manager\ManagerInterface;
use Theutz\Unite\Concerns\Parser\ParserInterface;
use Theutz\Unite\Concerns\Unit\UnitDto;
use Theutz\Unite\Concerns\Value\ValueDto;

class Unite implements UniteInterface
{
    public function __construct(
        private ParserInterface $parser,
        private ManagerInterface $manager,
    ) {
    }

    public function make(
        BigNumber|float|int|string $quantity,
        UnitDto|string $unit
    ): ManagerInterface {
        $value = new ValueDto(
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
