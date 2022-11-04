<?php

namespace Theutz\Unite\Collections;

use Countable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use RuntimeException;
use Traversable;

/**
 * @mixin Collection
 */
abstract class AbstractCollection implements IteratorAggregate, Countable
{
    protected Collection $collection;

    public function __construct(array $array)
    {
        $this->collection = collect($array);
    }

    public function __call(string $name, array $args)
    {
        if (method_exists($this->collection, $name)) {
            return $this->collection->$name(...$args);
        }

        throw new RuntimeException("'{$name}' is not a valid method.");
    }

    public function getIterator(): Traversable
    {
        return $this->collection;
    }

    public function count(): int
    {
        return $this->collection->count();
    }
}
