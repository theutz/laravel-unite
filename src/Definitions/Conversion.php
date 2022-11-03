<?php

namespace Theutz\Unite\Definitions;

class Conversion
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        public readonly string $factor,
    ) {
    }
}
