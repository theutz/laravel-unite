<?php

namespace Theutz\Unite\Definitions;

use Illuminate\Support\Collection;

class UnitDefinition
{
    public readonly Collection $aliases;

    public readonly Collection $systems;

    public readonly Collection $to;

    public function __construct(
        public readonly string $symbol,
        public readonly string $name,
        array $aliases,
        public readonly string $kind,
        array $systems,
        array $to
    ) {
        $this->aliases = collect($aliases);
        $this->systems = collect($systems);
        $this->to = collect($to);
    }
}
