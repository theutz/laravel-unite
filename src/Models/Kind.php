<?php

namespace Theutz\Unite\Models;

use Theutz\Unite\Category;
use Theutz\Unite\Data\Model;

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
