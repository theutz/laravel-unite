<?php

use Theutz\Unite\Category;

$categories = collect(Category::cases())
    ->mapWithKeys(fn ($item) => [$item->value => $item]);

dataset('categories', $categories);
