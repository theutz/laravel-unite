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

    public function toLang(): array
    {
        $sep = config('unite.plural_separator');

        return $this->collection->reduce(
            function ($carry, $unit) use ($sep) {
                $carry->put($unit->symbol, $unit->name);

                // Push all names and aliases as keys, with
                // the symbol as the value for future lookups.
                $unit->aliases
                    ->merge($unit->name)
                    ->map(
                        fn ($n) => str($n)
                            ->explode($sep)
                            ->all()
                    )
                    ->flatten()
                    ->each(fn ($n) => $carry->put($n, $unit->symbol));

                return $carry;
            },
            collect()
        )->all();
    }

    public function getSymbolToNameMap(): array
    {
        return $this->collection
            ->mapWithKeys(fn ($unit, $key) => [$unit->symbol => $unit->name])
            ->all();
    }

    private function generateSiUnits(Collection $units): Collection
    {
        return $units->reduce(
            function (Collection $units, UnitDefinition $unit) {
                $units->push($unit);

                if ($unit->systems->contains('si')) {
                    $this->loader
                        ->prefixes()
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
        $sep = config('unite.plural_separator');

        return str($base)
            ->explode($sep)
            ->map(fn ($piece) => $prefix.$piece)
            ->join($sep);
    }
}
