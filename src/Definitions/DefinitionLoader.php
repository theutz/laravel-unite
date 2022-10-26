<?php

namespace Theutz\Unite\Definitions;

use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;

class DefinitionLoader
{
    public function __construct(
        private Yaml $yaml,
    ) {
    }

    public function units(): Collection
    {
        $raw = $this->yaml->parseFile(
            config('unite.units')
        );

        return collect($raw)
            ->map(fn ($data) => new UnitDefinition(...$data));
    }

    public function prefixes(): Collection
    {
        $raw = $this->yaml->parseFile(config('unite.prefixes'));

        return collect($raw)
            ->map(fn ($data) => new PrefixDefinition(...$data));
    }
}
