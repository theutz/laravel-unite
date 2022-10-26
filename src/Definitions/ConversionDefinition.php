<?php

namespace Theutz\Unite\Definitions;

class ConversionDefinition
{
    public function __construct(
        public readonly string $symbol,
        public readonly string $factor,
    ) {
    }
}
