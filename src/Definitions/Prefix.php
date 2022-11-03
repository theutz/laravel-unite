<?php

namespace Theutz\Unite\Definitions;

class Prefix
{
    public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        public readonly string $factor
    ) {
    }
}
