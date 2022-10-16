<?php

namespace Theutz\Unite\Parser;

use Theutz\Unite\Formatters\Decimal;
use Theutz\Unite\Models\Unit;

class Parser
{
    public function __construct(
        private Decimal $numfmt
    ) {
    }

    /**
     * @return array{string, string}
     */
    public function parse(string $string): array
    {
        return ['', ''];
    }

    /**
     * @return array{string, string}
     *
     * @throws ParseException
     */
    public function splitQuantityAndUnit(string $string): array
    {
        $matches = [];

        preg_match('/^(.*?)(\D+)$/', $string, $matches);

        [$quantity, $unit] = collect($matches)
            ->whenEmpty(fn () => throw new ParseException($string))
            ->slice(1)
            ->values()
            ->map(fn ($i) => (string) str($i)->trim())
            ->all();

        return [
            $this->parseQuantity($quantity),
            $unit,
        ];
    }

    /**
     * @return array{?string, string}
     *
     * @throws UnitParseException
     */
    public function splitPrefixAndUnit(string $string): array
    {
        $unit = $this->parseUnit($string);
        $prefix = (string) str($string)->remove($unit);

        return [$prefix, $unit];
    }

    /**
     * @throws QuantityParseException
     */
    public function parseQuantity(string $quantity): string
    {
        if ($parsed = $this->numfmt->parse($quantity)) {
            return $quantity;
        }

        throw new QuantityParseException($quantity);
    }

    /**
     * @throws UnitParseException
     */
    public function parseUnit(string $string): string
    {
        $unit = Unit::pluck('id')
            ->map(fn ($key) => __($key))
            ->first(fn ($name) => str($string)->endsWith($name));

        if (! $unit) {
            throw new UnitParseException($string);
        }

        return $unit;
    }
}
