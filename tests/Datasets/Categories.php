<?php

use Theutz\Unite\Data\Finder;

$categories = collect(app(Finder::class)->find())
    ->mapWithKeys(fn ($className) => [class_basename($className) => app($className)]);

dataset('categories', $categories);
