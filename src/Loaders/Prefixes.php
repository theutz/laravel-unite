<?php

namespace Theutz\Unite\Loaders;

use Illuminate\Support\Collection;
use Theutz\Unite\Definitions\PrefixDefinition;

class Prefixes
{
    private Collection $collection;

    public function load(): Collection
    {
        if (!isset($this->collection)) {
            $raw = config('unite.prefixes');
            $this->collection = $this->mapToDefinitions($raw);
        }

        return $this->collection;
    }

    private function mapToDefinitions(array $raw): Collection
    {
        return collect($raw)
            ->map(fn ($p) => new PrefixDefinition(...$p));
    }
}
