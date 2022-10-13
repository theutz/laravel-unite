<?php

namespace Theutz\Unite\Models;

use Illuminate\Support\Collection;
use Theutz\Unite\Category;
use Theutz\Unite\Loader;

/**
 * @mixin Collection
 */
class Unit
{
    private Collection $data;

    public function __construct(
        private Loader $loader
    ) {
    }

    public static function __callStatic($name, $args)
    {
        $instance = app(self::class);

        return $instance->getData()->$name($args);
    }

    private function getData(): Collection
    {
        if (! isset($this->data)) {
            $data = $this->loader->load(Category::Unit);
            $this->data = collect($data);
        }

        return $this->data;
    }
}
