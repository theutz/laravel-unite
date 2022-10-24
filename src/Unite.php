<?php

namespace Theutz\Unite;

use Brick\Math\BigDecimal;
use Brick\Math\BigNumber;
use Brick\Math\RoundingMode;

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
        $factor = collect(config('unite.conversions'))
            ->filter(
                fn ($factor, $key) => str($key)->startsWith($this->unit) &&
                    str($key)->endsWith($unit)
            )->firstOrFail();

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
}
