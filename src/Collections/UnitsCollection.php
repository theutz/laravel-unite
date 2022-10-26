<?php

namespace Theutz\Unite\Collections;

use Countable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use Theutz\Unite\Definitions\DefinitionLoader;
use Traversable;

/**
 * @mixin Collection
 */
class UnitsCollection implements IteratorAggregate, Countable
{
    private Collection $collection;

    public function __construct(
        DefinitionLoader $loader
    ) {
        $this->collection = collect($loader->units());
    }

    public function getIterator(): Traversable
    {
        return $this->collection;
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    public function __call($name, $args)
    {
        if (method_exists($this->collection, $name)) {
            return $this->collection->$name(...$args);
        }
    }
}
