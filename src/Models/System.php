<?php

namespace Theutz\Unite\Models;

use Illuminate\Support\Collection;
use Theutz\Unite\Category;
use Theutz\Unite\Data\Model;

/**
 * {@inheritDoc}
 */
class System extends Model
{
    protected function category(): Category
    {
        return Category::System;
    }
}
