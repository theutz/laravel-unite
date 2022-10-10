<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Manager\ManagerInterface;
use Theutz\Unite\Concerns\Parser\ParserInterface;
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
        string $unit
    ): ManagerInterface {
        $value = new ValueDto(
            $this->parser->parseQuantity($quantity),
            ...$this->parser->parseUnit($unit)
        );

        $this->manager->value = $value;

        return $this->manager;
    }

    public function parse(string $str): ManagerInterface
    {
        $value = $this->parser->parse($str);

        return $this->make($value->quantity, "{$value->prefix->value}{$value->baseUnit->value}");
    }
}
