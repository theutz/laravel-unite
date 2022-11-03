<?php

namespace Theutz\Unite\Values;

use Illuminate\Support\Collection;
use Theutz\Unite\Definitions\Unit as Definition;

class Unit
{
    public readonly string $symbol;

    public readonly string $name;

    public readonly string $kind;

    public readonly Collection $aliases;

    public readonly Collection $systems;

    public function __construct(
        Definition $definition
    ) {
        $this->symbol = $definition->symbol;
        $this->name = $definition->name;
        $this->kind = $definition->kind;
        $this->aliases = collect($definition->aliases);
        $this->systems = collect($definition->systems);
    }

    public static function make(Definition $definition): self
    {
        return app(self::class, ['definition' => $definition]);
    }
}
