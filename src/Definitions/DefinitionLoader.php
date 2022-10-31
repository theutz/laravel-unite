<?php

namespace Theutz\Unite\Definitions;

use Illuminate\Support\Collection;

class DefinitionLoader
{
    public function __construct(
    ) {
    }

    public function units(): Collection
    {
        $raw = config('unite-units');

        return collect($raw)
            ->map(fn ($data) => new UnitDefinition(...$data));
    }

    public function prefixes(): Collection
    {
        $raw = config('unite-prefixes');

        return collect($raw)
            ->map(fn ($data) => new PrefixDefinition(...$data));
    }
}
