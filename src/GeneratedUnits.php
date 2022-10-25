<?php

namespace Theutz\Unite;

class GeneratedUnits
{
    const ALIAS_SEPARATOR = ';;';

    const PLURAL_SEPARATOR = '|';

    public function __construct(
        private array $units
    ) {
    }

    public function generate(): array
    {
        return cache()->get('unite.units', function () {
            return $this->units();
        });
    }

    private function units(): array
    {
        return collect($this->units)
            ->reduce(function ($carry, $item, $key) {
                $names = str($item)->explode(self::ALIAS_SEPARATOR);

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
