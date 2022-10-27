<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;
use RuntimeException;
use Theutz\Unite\Collections\UnitsCollection;
use Theutz\Unite\Definitions\UnitDefinition;

class Unite
{
    private string $quantity;

    private UnitDefinition $unit;

    public function __construct(
        private UnitsCollection $units
    ) {
    }

    public function convert(string $string): self
    {
        [$this->quantity, $this->unit] = $this->parse($string);

        return $this;
    }

    public function to(string $unit): string
    {
        $factor = $this->getConversionFactor($unit);

        $quantity = BigDecimal::of($this->quantity)->multipliedBy($factor);
        $quantity = str($quantity)->rtrim(0);

        return "{$quantity} {$unit}";
    }

    /**
     * @return array{0: string, 1: UnitDefinition}
     */
    private function parse(string $string): array
    {
        preg_match(
            pattern: '/^(.*?)(\D+)[23]?$/',
            subject: $string,
            matches: $matches
        );

        [, $quantity, $unit] = array_map('trim', $matches);

        if (count($matches) < 3) {
            throw new RuntimeException("{$string} is not valid.");
        }

        return [$quantity, $this->getUnit($unit)];
    }

    private function getUnit(string $unit): UnitDefinition
    {
        return $this->units
            ->filter(function ($u) use ($unit) {
                $isASymbol = $u->symbol === $unit;
                $canMapToASymbol = __('unite::symbols.' . $unit) === $u->symbol;

                return $isASymbol || $canMapToASymbol;
            })
            ->sole();
    }

    private function getConversionFactor(string $unit): string
    {
        [, $toUnit] = $this->parse($unit);

        return $this->unit->to->firstWhere('symbol', $toUnit->symbol)->factor;
    }
}
