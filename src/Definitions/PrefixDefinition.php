<?php

namespace Theutz\Unite\Definitions;

class PrefixDefinition
{
    public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        public readonly string $factor
    ) {
    }
}
