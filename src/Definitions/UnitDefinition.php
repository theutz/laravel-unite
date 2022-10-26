<?php

namespace Theutz\Unite\Definitions;

use ErrorException;

class UnitDefinition
{
    public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        public readonly array $aliases,
        public readonly string $kind,
        public readonly array $systems,
        public readonly array $to
    ) {
    }
}
