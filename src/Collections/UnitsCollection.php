<?php

namespace Theutz\Unite\Collections;

use Brick\Math\BigDecimal;
use Countable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use Theutz\Unite\Definitions\ConversionDefinition;
use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Definitions\PrefixDefinition;
use Theutz\Unite\Definitions\UnitDefinition;
use Traversable;
use Theutz\Unite\Loaders\Units as UnitsLoader;
use Theutz\Unite\Loaders\Prefixes as PrefixesLoader;

/**
 * @mixin Collection
 */
class UnitsCollection implements IteratorAggregate, Countable
{
    private Collection $collection;

    public function __construct(
        private UnitsLoader $unitsLoader,
        private PrefixesLoader $prefixesLoader
    ) {
        $this->collection = $this->generateSiUnits(
            $this->unitsLoader->load()
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

    private function generateSiUnits(Collection $units): Collection
    {
        return $units->reduce(
            function (Collection $units, UnitDefinition $unit) {
                $units->push($unit);

                if ($unit->systems->contains('si')) {
                    $this->prefixesLoader
                        ->load()
                        ->each(fn ($prefix) => $units->push(
                            $this->makePrefixedUnit($prefix, $unit)
                        ));
                }

                return $units;
            },
            collect()
        );
    }

    private function makePrefixedUnit(PrefixDefinition $prefix, UnitDefinition $unit): UnitDefinition
    {
        return new UnitDefinition(
            symbol: $prefix->symbol.$unit->symbol,
            name: $this->prefixPluralizedString($unit->name, $prefix->name),
            kind: $unit->kind,
            systems: $unit->systems,
            aliases: $unit->aliases->map(
                fn ($alias) => $this->prefixPluralizedString($alias, $prefix->name)
            ),
            to: $unit->to->map(fn (ConversionDefinition $conv) => new ConversionDefinition(
                symbol: $conv->symbol,
                factor: str(BigDecimal::of($conv->factor)->multipliedBy($prefix->factor))->rtrim(0)
            )),
        );
    }

    private function prefixPluralizedString(string $base, string $prefix): string
    {
        return str($base)
            ->explode('|')
            ->map(fn ($piece) => $prefix.$piece)
            ->join('|');
    }
}
