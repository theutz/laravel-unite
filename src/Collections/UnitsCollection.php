<?php

namespace Theutz\Unite\Collections;

use Countable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use Theutz\Unite\Definitions\Prefix;
use Theutz\Unite\Definitions\Unit;
use Traversable;

/**
 * @mixin Collection
 */
class UnitsCollection implements IteratorAggregate, Countable
{
    private Collection $collection;

    public function __construct()
    {
        $this->collection = $this->generateSiUnits(
            config('unite.units')
        );
    }

    public function __call($name, $args)
    {
        if (method_exists($this->collection, $name)) {
            return $this->collection->$name(...$args);
        }

        throw new \RuntimeException("'{$name}' is not a valid method.");
    }

    public function getIterator(): Traversable
    {
        return $this->collection;
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    private function generateSiUnits(iterable $units): Collection
    {
        return collect($units)->reduce(
            function (Collection $units, Unit $unit) {
                $units->push($unit);

                if ($unit->systems->contains('si')) {
                    collect(config('unite.prefixes'))
                        ->each(fn ($prefix) => $units->push(
                            $this->makePrefixedUnit($prefix, $unit)
                        ));
                }

                return $units;
            },
            collect()
        );
    }

    private function makePrefixedUnit(Prefix $prefix, Unit $unit): Unit
    {
        return new Unit(
            symbol: $prefix->symbol . $unit->symbol,
            name: $this->prefixPluralizedString($unit->name, $prefix->name),
            kind: $unit->kind,
            systems: $unit->systems,
            aliases: $unit->aliases->map(
                fn ($alias) => $this->prefixPluralizedString($alias, $prefix->name)
            ),
        );
    }

    private function prefixPluralizedString(string $base, string $prefix): string
    {
        return str($base)
            ->explode('|')
            ->map(fn ($piece) => $prefix . $piece)
            ->join('|');
    }
}
