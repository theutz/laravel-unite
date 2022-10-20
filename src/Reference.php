<?php

namespace Theutz\Unite;

use Illuminate\Support\Collection;

class Reference
{
    const CONFIG_PREFIX = 'unite.';

    public function config(string $key): mixed
    {
        $key = self::CONFIG_PREFIX.$key;

        return config($key);
    }

    public function units(): Collection
    {
        $systems = collect($this->config('unit-belongs-to-systems'))
            ->map(fn ($item) => ['systems' => str($item)->explode(',')]);

        $units = collect($this->config('units'))
            ->map(fn ($item) => ['kind' => $item])
            ->mergeRecursive($systems)
            ->map(fn ($item, $key) => ['id' => $key, ...$item])
            ->values();

        return collect($units);
    }

    public function conversions(): Collection
    {
        return collect($this->config('conversions'))
            ->map(function ($factor, $key) {
                [$from, $to] = str($key)->explode(' -> ');

                return compact('from', 'to', 'factor');
            })
            ->values();
    }
}
