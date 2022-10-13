<?php

namespace Theutz\Unite\Models;

use Illuminate\Support\Collection;
use Theutz\Unite\Category;
use Theutz\Unite\Loader;

/**
 * {@inheritDoc}
 */
class Unit extends Model
{
    protected function category(): Category
    {
        return Category::Unit;
    }

    protected function coerce(Collection $collection): Collection
    {
        return $collection
            ->map(fn ($item, $key) => ['id' => $key, ...$item])
            ->values();
    }
}
