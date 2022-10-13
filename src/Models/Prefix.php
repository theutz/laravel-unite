<?php

namespace Theutz\Unite\Models;

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
}
