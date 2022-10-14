<?php

namespace Theutz\Unite\Parser;

use Theutz\Unite\Models\Unit;

class Parser
{
    /**
     * @return array{string, string}
     */
    public function parse(string $string): array
    {
        [$quantity, $unit] = $this->splitQuantityAndUnit($string);

        return [$quantity, $unit];
    }

    /**
     * @return array{string, string}
     */
    public function splitQuantityAndUnit(string $string): array
    {
        $matches = [];

        preg_match('/^(.*?)(\D*)$/', $string, $matches);

        return collect($matches)
            ->slice(1)
            ->values()
            ->map(fn ($i) => (string) str($i)->trim())
            ->all();
    }

    /**
     * @return array{?string, string}
     */
    public function splitPrefixAndUnit(string $string): array
    {
        $unit = Unit::pluck('id')
            ->map(fn ($key) => __($key))
            ->firstOrFail(fn ($name) => str($string)->endsWith($name));

        $prefix = str($string)->remove($unit);

        return [(string) $prefix, $unit];
    }
}
