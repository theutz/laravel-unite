<?php

namespace Theutz\Unite\Models;

use Theutz\Unite\Category;

/**
 * {@inheritDoc}
 */
class Kind extends Model
{
    protected function category(): Category
    {
        return Category::Kind;
    }
}
