<?php

namespace Theutz\Unite\Collections;

use Illuminate\Support\Collection;
use Theutz\Unite\Definitions\Prefix;
use Theutz\Unite\Definitions\Unit;
use Theutz\Unite\Values\Unit as UnitValue;

/**
 * @mixin Collection
 */
class Units extends AbstractCollection
{
    public function __construct(
        array $units
    ) {
        $this->collection = $this->generateSiUnits($units);
    }

    private function generateSiUnits(iterable $units): Collection
    {
        return collect($units)->reduce(
            function (Collection $units, UnitValue $unit) {
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

    private function makePrefixedUnit(Prefix $prefix, UnitValue $unit): Unit
    {
        return new Unit(
            symbol: $prefix->symbol.$unit->symbol,
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
            ->map(fn ($piece) => $prefix.$piece)
            ->join('|');
    }
}
