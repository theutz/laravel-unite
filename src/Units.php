<?php

namespace Theutz\Unite;

class Units
{
    const PLURAL_SEPARATOR = '|';

    public function __construct(
        private Loader $loader
    ) {
    }

    public function all(): array
    {
        return collect($this->loader->units())
            ->map(fn ($item, $key) => [...$item, 'symbol' => $key])
            ->all();
    }

    public function generateLang(): array
    {
        return $this->toLangAliases($this->all());
    }

    private function toLangAliases(array $units): array
    {
        return collect($units)
            ->reduce(function ($carry, $unit, $symbol) {
                $carry->put($symbol, $unit['name']);

                collect($unit['aliases'])
                    ->merge($unit['name'])
                    ->each(
                        fn ($nameDef) => str($nameDef)
                            ->explode(self::PLURAL_SEPARATOR)
                            ->each(fn ($name) => $carry->put($name, $symbol))
                    );

                return $carry;
            }, collect())
            ->all();
    }
}
