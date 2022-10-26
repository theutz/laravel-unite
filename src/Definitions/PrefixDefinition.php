<?php

namespace Theutz\Unite\Definitions;

class PrefixDefinition
{
    final public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        public readonly string $factor
    ) {
    }

    public static function make(array $data)
    {
        return new static(
            symbol: $data['symbol'],
            name: $data['name'],
            factor: $data['factor']
        );
    }
}
