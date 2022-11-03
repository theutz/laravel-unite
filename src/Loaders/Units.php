<?php

namespace Theutz\Unite\Loaders;

use Illuminate\Support\Collection;
use Theutz\Unite\Definitions\Unit;

class Units
{
    public function load(): Collection
    {
        $raw = config('unite.units');

        return $this->mapToDefinitions($raw);
    }

    private function mapToDefinitions(array $raw): Collection
    {
        return collect($raw)
            ->map(fn ($u) => new Unit(...$u));
    }
}
