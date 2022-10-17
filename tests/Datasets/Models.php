<?php

use Theutz\Unite\Data\Finder;

$models = collect(app(Finder::class)->find())
    ->mapWithKeys(fn ($className) => [class_basename($className) => app($className)]);

dataset('models', $models);
