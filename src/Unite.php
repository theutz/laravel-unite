<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;
use RuntimeException;

class Unite
{
    private string $quantity;

    private string $unit;

    public function convert(string $string): self
    {
        [$this->quantity, $this->unit] = $this->parse($string);

        return $this;
    }

    public function to(string $unit): string
    {
        $factor = $this->findFactor(from: $this->unit, to: $unit);

        $quantity = BigDecimal::of($this->quantity)->multipliedBy($factor);
        $quantity = str($quantity)->rtrim(0);

        return "{$quantity} {$unit}";
    }

    /**
     * @return array{0: string, 1: string}
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

        return [$quantity, $unit];
    }

    private function findFactor(string $from, string $to): ?string
    {
        [$from, $to] = array_map([$this, 'getUnitKey'], [$from, $to]);

        return collect(config('unite.conversions'))
            ->filter(fn ($factor, $key) => str($key)->startsWith($from)
                && str($key)->endsWith($to))
            ->first();
    }

    private function getUnitKey(string $unit): string
    {
        $key = collect(config('unite.units'))
            ->keys()
            ->filter(function ($u) use ($unit) {
                return $unit === $u || __('unite::units.'.$unit) === $u;
            })
            ->first();

        return $key;
    }
}
