<?php

namespace Theutz\Unite\Definitions;

use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;

class DefinitionLoader
{
    public function __construct(
        private Yaml $yaml,
        private string $unitsPath,
    ) {
    }

    public function units(): Collection
    {
        $raw = $this->yaml->parseFile($this->unitsPath);

        return collect($raw)
            ->map([UnitDefinition::class, 'make']);
    }
}
