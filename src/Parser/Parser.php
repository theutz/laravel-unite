<?php

namespace Theutz\Unite\Parser;

use Illuminate\Support\Str;
use NumberFormatter;
use Theutz\Unite\Intl\NumberFormatterBuilder;
use Theutz\Unite\Models\Prefix;
use Theutz\Unite\Models\Unit;

class Parser
{
    private NumberFormatter $numberParser;

    public function __construct(
        NumberFormatterBuilder $numberFormatBuilder
    ) {
        $this->numberParser = $numberFormatBuilder->build();
    }

    /**
     * @return array{string, ?string, string}
     */
    public function parse(string $string): array
    {
        [$quantity, $unit] = $this->splitQuantityAndUnit($string);
        [$prefix, $unit] = $this->splitPrefixAndUnit($unit);

        return [$quantity, $prefix, $unit];
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
        $prefix = $this->extractPrefix($string, $unit);

        return [$prefix, $unit];
    }

    /**
     * @throws QuantityParseException
     */
    public function parseQuantity(string $quantity): string
    {
        if ($parsed = $this->numberParser->parse($quantity)) {
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

    /**
     * @throws PrefixParseException
     */
    public function extractPrefix(string $string, string $unit): ?string
    {
        $prefix = Str::remove($unit, $string);

        if (blank($prefix)) {
            return null;
        }

        $found = Prefix::firstWhere('abbr', $prefix);

        if (! $found) {
            throw new PrefixParseException($string);
        }

        return $prefix;
    }
}
