<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;
use RuntimeException;

class Unite
{
    private string $quantity;

    private array $unit;

    public function __construct(
        private Units $units
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
     * @return array{0: string, 1: array}
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

    private function getUnit(string $unit): array
    {
        return collect($this->units->all())
            ->filter(fn ($_, $symbol) => $unit === $symbol || __('unite::units.'.$unit) === $symbol)
            ->sole();
    }

    private function getConversionFactor(string $unit): string
    {
        [, $toUnit] = $this->parse($unit);
        ['symbol' => $symbol] = $toUnit;

        return $this->unit['to'][$symbol];
    }
}
