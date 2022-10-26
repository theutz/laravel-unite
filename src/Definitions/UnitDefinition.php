<?php

namespace Theutz\Unite\Definitions;

class UnitDefinition
{
    final public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        public readonly array $aliases,
        public readonly string $kind,
        public readonly array $to
    ) {
    }

    public static function make(array $data)
    {
        return new static(
            symbol: $data['symbol'],
            name: $data['name'],
            aliases: $data['aliases'],
            kind: $data['kind'],
            to: $data['to']
        );
    }
}
