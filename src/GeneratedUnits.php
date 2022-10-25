<?php

namespace Theutz\Unite;

class GeneratedUnits
{
    const PLURAL_SEPARATOR = '|';

    public function __construct(
        private array $units
    ) {
    }

    public function generate(): array
    {
        return cache()->get('unite.units', function() {
            return $this->units();
        });
    }

    private function units(): array
    {
        return collect($this->units)
            ->reduce(function ($carry, $item, $key) {
                $names = collect($item);
                $carry->put($key, $names->first());

                $names
                    ->map(fn ($name) => str($name)
                        ->explode(self::PLURAL_SEPARATOR))
                    ->flatten()
                    ->each(fn ($name) => $carry->put($name, $key));

                return $carry;
            }, collect())
            ->all();
    }
}
