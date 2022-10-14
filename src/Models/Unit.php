<?php

namespace Theutz\Unite\Models;

use Illuminate\Support\Collection;
use Theutz\Unite\Category;

/**
 * {@inheritDoc}
 */
class Unit extends Model
{
    protected function category(): Category
    {
        return Category::Unit;
    }
}
