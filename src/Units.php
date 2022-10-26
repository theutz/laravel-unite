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
        return $this->loader->units();
    }

    public function generateLang(): array
    {
        return $this->toLangAliases($this->all());
    }

    private function toLangAliases(array $units): array
    {
        return collect($units)
            ->reduce(function ($carry, $unit) {
                $carry->put($unit['symbol'], $unit['name']);

                collect($unit['aliases'])
                    ->merge($unit['name'])
                    ->each(
                        fn ($nameDef) => str($nameDef)
                            ->explode(self::PLURAL_SEPARATOR)
                            ->each(fn ($name) => $carry->put($name, $unit['symbol']))
                    );

                return $carry;
            }, collect())
            ->all();
    }
}
