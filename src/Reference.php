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
        $systems = $this->unitToSystems()
            ->map(fn ($item) => ['systems' => $item]);

        return collect($this->config('units'))
            ->map(fn ($item) => ['kind' => $item])
            ->mergeRecursive($systems)
            ->map(fn ($item, $key) => ['id' => $key, ...$item])
            ->values();
    }

    public function conversions(): Collection
    {
        return collect($this->config('conversions'))
            ->map(function ($factor, $key) {
                [$from, $to] = array_map('trim', explode('->', $key));

                return compact('from', 'to', 'factor');
            })
            ->values();
    }

    public function systems(): Collection
    {
        return collect($this->config('systems'));
    }

    public function kinds(): Collection
    {
        return collect($this->config('kinds'));
    }

    public function prefixes(): Collection
    {
        return collect($this->config('prefixes'))
            ->map(fn ($item, $key) => ['id' => $key, 'magnitude' => $item])
            ->values();
    }

    public function unitToSystems(): Collection
    {
        return collect($this->config('unit-to-systems'))
            ->map(fn ($item) => str($item)->explode(','));
    }
}
