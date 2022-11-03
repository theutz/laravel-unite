<?php

namespace Theutz\Unite\Definitions;

use Illuminate\Support\Collection;

/**
 * @property Collection<int, string> $aliases
 * @property Collection<int, string> $systems
 */
class Unit
{
    public readonly Collection $aliases;

    public readonly Collection $systems;

    public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        Collection|array $aliases,
        public readonly string $kind,
        Collection|array $systems,
    ) {
        $this->aliases = collect($aliases);
        $this->systems = collect($systems);
    }
}
