<?php

namespace Theutz\Unite;

use Symfony\Component\Yaml\Yaml;

class GeneratedUnits
{
    const PLURAL_SEPARATOR = '|';

    public function __construct(
        private Yaml $yaml,
        private string $units
    ) {
    }

    public function generate(): array
    {
        $units = $this->getUnits();

        return $this->transformToAliases($units);
    }

    private function getUnits(): array
    {
        $filepath = config('unite.units');

        return $this->yaml->parseFile($filepath);
    }

    private function transformToAliases(array $units): array
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
