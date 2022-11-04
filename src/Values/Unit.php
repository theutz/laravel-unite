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
        private Definition $definition
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

    public function withPrefix(Prefix $prefix): self
    {
        $def = new Definition(
            symbol: str($this->definition->symbol)->prepend($prefix->symbol),
            name: $this->prependPrefixToName($prefix->name, $this->definition->name),
            aliases: collect($this->definition->aliases)
                ->map(fn ($alias) => $this->prependPrefixToName($prefix->name, $alias))
                ->all(),
            kind: $this->definition->kind,
            systems: $this->definition->systems,
        );

        return $this->make($def);
    }

    private function prependPrefixToName(string $prefix, string $name): string
    {
        return str($name)
            ->explode('|')
            ->map(fn ($piece) => str($piece)->prepend($prefix))
            ->join('|');
    }
}
