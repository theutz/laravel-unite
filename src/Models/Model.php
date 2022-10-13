<?php

namespace Theutz\Unite\Models;

use Illuminate\Support\Collection;
use Theutz\Unite\Category;
use Theutz\Unite\Loader;

/**
 * @mixin Collection
 */
abstract class Model
{
    private Collection $data;

    public function __construct(
        private Loader $loader
    ) {
    }

    protected function data(): Collection
    {
        if (! isset($this->data)) {
            $data = $this->loader->load($this->category());
            $this->data = collect($data);
        }

        return $this->data;
    }

    public static function __callStatic($name, $args)
    {
        $instance = app(static::class);

        return $instance->data()->$name($args);
    }

    abstract protected function category(): Category;
}
