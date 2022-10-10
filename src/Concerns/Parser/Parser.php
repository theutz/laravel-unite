<?php

namespace Theutz\Unite\Concerns\Parser;

use Brick\Math\BigNumber;
use Brick\Math\Exception\NumberFormatException;
use Illuminate\Support\ItemNotFoundException;
use Theutz\Unite\Concerns\Unit\UnitDto;
use Theutz\Unite\Concerns\Value\ValueDto;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

class Parser implements ParserInterface
{
    public function parse(string $str): ValueDto
    {
        if (count($parts = explode(separator: ' ', string: $str, limit: 2)) !== 2) {
            throw new ParseException('The quantity and unit must be separated by a space.');
        }

        [$quantity, $unit] = $parts;

        return new ValueDto(
            $this->parseQuantity($quantity),
            ...$this->parseUnit($unit)
        );
    }

    public function parseQuantity(BigNumber|int|float|string $quantity): BigNumber
    {
        try {
            return BigNumber::of($quantity);
        } catch (NumberFormatException $e) {
            throw new InvalidQuantityException($quantity);
        }
    }

    /**
     * @return array{0: ?\Theutz\Unite\Enums\Prefix, 1: \Theutz\Unite\Enums\BaseUnit}
     */
    public function parseUnit(string $unit): array
    {
        if ($baseUnit = BaseUnit::tryFrom($unit)) {
            return [null, $baseUnit];
        }

        $baseUnit = $this->extractBaseUnit($unit);
        $prefix = $this->extractPrefix($unit, $baseUnit);

        return [$prefix, $baseUnit];
    }

    private function extractPrefix(string $unit, BaseUnit $baseUnit)
    {
        try {
            $unit = str($unit);
            $baseUnit = str($baseUnit->value);
            $substr = $unit->substr(start: 0, length: $unit->length() - $baseUnit->length());

            return Prefix::from($substr);
        } catch (\ValueError $e) {
            throw new InvalidUnitPrefixException($unit);
        }
    }

    private function extractBaseUnit(string $unit): BaseUnit
    {
        try {
            return collect(BaseUnit::cases())
                ->firstOrFail(fn ($u) => str($unit)->endsWith($u->value));
        } catch (ItemNotFoundException $e) {
            throw new InvalidBaseUnitException($unit);
        }
    }
}
