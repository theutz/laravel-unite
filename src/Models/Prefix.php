<?php

namespace Theutz\Unite\Models;

use Illuminate\Support\Collection;
use Theutz\Unite\Category;

/**
 * {@inheritDoc}
 */
class Prefix extends Model
{
    protected function category(): Category
    {
        return Category::Prefix;
    }

    protected function coerce(Collection $collection): Collection
    {
        return $collection
            ->map(fn ($item, $key) => ['id' => $key, ...$item])
            ->values();
    }
}
