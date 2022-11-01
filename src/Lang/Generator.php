<?php

namespace Theutz\Unite\Lang;

use Theutz\Unite\Collections\UnitsCollection;

class Generator
{
    private array $namesToSymbols;

    private array $symbolsToNames;

    public function __construct(
        protected UnitsCollection $units
    ) {
    }

    /**
     * Generates an array to be consumed by Laravel's localization
     * mechanisms in order to get a correctly pluralized name from
     * a Unite `symbol`.
     *
     * @return array<string, string>
     */
    public function symbolsToNames(): array
    {
        if ($this->symbolsToNames) {
            return $this->symbolsToNames;
        }

        return $this->symbolsToNames = $this->units
            ->mapWithKeys(fn ($unit, $key) => [$unit->symbol => $unit->name])
            ->all();
    }

    /**
     * Generates an array to be consumed by Laravel's localization
     * mechanisms in order to get the Unite `symbol` from a name
     * or alias.
     *
     * @return array<string, string>
     */
    public function namesToSymbols(): array
    {
        if ($this->namesToSymbols) {
            return $this->namesToSymbols;
        }

        return $this->namesToSymbols = $this->units
            ->reduce(function ($carry, $unit) {
                $unit->aliases
                    ->merge($unit->name)
                    ->map(fn ($name) => str($name)->explode('|'))
                    ->flatten()
                    ->each(fn ($name) => $carry->put($name, $unit->symbol));

                return $carry;
            }, collect())
            ->all();
    }
}
