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
            $this->validateQuantity($quantity),
            $unit,
        ];
    }

    /**
     * @return array{?string, string}
     */
    public function splitPrefixAndUnit(string $string): array
    {
        $unit = Unit::pluck('id')
            ->map(fn ($key) => __($key))
            ->firstOrFail(fn ($name) => str($string)->endsWith($name));

        $prefix = str($string)->remove($unit);

        return [(string) $prefix, $unit];
    }

    /**
     * @throws QuantityParseException
     */
    private function validateQuantity(string $quantity): string
    {
        if ($this->numfmt->parse($quantity)) {
            return $quantity;
        }
        throw new QuantityParseException($quantity);
    }
}
