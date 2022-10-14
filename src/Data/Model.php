<?php

namespace Theutz\Unite\Data;

use Illuminate\Support\Collection;

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
            $data = $this->loader->load($this);
            $collection = collect($data);

            $this->data = $this->coerce($collection);
        }

        return $this->data;
    }

    public static function __callStatic($name, $args)
    {
        $instance = app(static::class);

        return $instance->data()->$name($args);
    }

    /**
     * Override this function if you wish to change
     * the default shape of the data. Otherwise,
     * this function is a noop;
     */
    protected function coerce(Collection $collection): Collection
    {
        return $this->createIdFromKey($collection);
    }

    protected function createIdFromKey(Collection $collection): Collection
    {
        return $collection
            ->map(fn ($item, $key) => ['id' => $key, ...$item])
            ->values();
    }
}
