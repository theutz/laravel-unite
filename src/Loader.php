<?php

namespace Theutz\Unite;

use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;
use Theutz\Unite\Definitions\UnitDefinition;

class Loader
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
