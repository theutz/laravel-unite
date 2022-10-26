<?php

namespace Theutz\Unite\Collections;

use Countable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Definitions\UnitDefinition;
use Traversable;

/**
 * @mixin Collection
 */
class UnitsCollection implements IteratorAggregate, Countable
{
    private Collection $collection;

    public function __construct(
        private DefinitionLoader $loader
    ) {
        $this->collection = $this->generateSiUnits(
            $loader->units()
        );
    }

    public function getIterator(): Traversable
    {
        return $this->collection;
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    public function __call($name, $args)
    {
        if (method_exists($this->collection, $name)) {
            return $this->collection->$name(...$args);
        }
    }

    private function generateSiUnits(Collection $units): Collection
    {
        return $units->reduce(
            function (Collection $carry, UnitDefinition $unit) {
                $carry->push($unit);

                if ($unit->systems->contains('si')) {
                    $this->loader->prefixes()
                        ->each(function ($prefix) use ($unit, $carry) {
                            $aliases = $unit->aliases->map(fn ($alias) => $this->prefixPluralizedString($alias, $prefix->name));
                            $to = [];

                            $prefixedUnit = new UnitDefinition(
                                symbol: $prefix->symbol . $unit->symbol,
                                name: $this->prefixPluralizedString($unit->name, $prefix->name),
                                kind: $unit->kind,
                                systems: $unit->systems,
                                aliases: $aliases,
                                to: $to,
                            );

                            $carry->push($prefixedUnit);
                        });
                }

                return $carry;
            },
            collect()
        );
    }

    private function prefixPluralizedString(string $base, string $prefix): string
    {
        $sep = config('unite.plural_separator');

        return str($base)
            ->explode($sep)
            ->map(fn ($piece) => $prefix . $piece)
            ->join($sep);
    }
}
