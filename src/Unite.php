<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;

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
    public function parse(string $string): array
    {
        preg_match(
            pattern: '/^(.*?)(\D+)[23]?$/',
            subject: $string,
            matches: $matches
        );

        [, $quantity, $unit] = $matches;

        return array_map('trim', [$quantity, $unit]);
    }

    private function findFactor(string $from, string $to)
    {
        return collect(config('unite.conversions'))
            ->filter(fn ($factor, $key) => str($key)->startsWith($from)
                && str($key)->endsWith($to))
            ->firstOrFail();
    }
}
