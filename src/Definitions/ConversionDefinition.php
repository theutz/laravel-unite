<?php

namespace Theutz\Unite\Definitions;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class ConversionDefinition implements IteratorAggregate
{
    public function __construct(
        public readonly string $symbol,
        public readonly string $factor,
    ) {
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator((array) $this);
    }
}
