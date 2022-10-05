<?php

namespace Theutz\Unite\Concerns\Parser;

use Brick\Math\BigNumber;
use Brick\Math\Exception\NumberFormatException;
use Illuminate\Support\ItemNotFoundException;
use Theutz\Unite\Contracts\Parser as Contract;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;
use Theutz\Unite\Unit;
use Theutz\Unite\Value;

class Parser implements Contract
{
    public function parseUnit(string $unit): Unit
    {
        $unit = str($unit);

        try {
            $baseUnit = BaseUnit::from($unit);

            return new Unit(prefix: null, baseUnit: $baseUnit);
        } catch (\ValueError $e) {
            // The unit given might have an SI prefix
        }

        try {
            $baseUnit = collect(BaseUnit::cases())
                ->firstOrFail(fn ($u) => $unit
                    ->endsWith($u->value));
            $prefix = Prefix::from($unit->substr(0, $unit->length() - str($baseUnit->value)->length()));
        } catch (ItemNotFoundException $e) {
            throw new InvalidBaseUnitException($unit);
        } catch (\ValueError $e) {
            throw new InvalidUnitPrefixException($unit);
        }

        return new Unit(prefix: $prefix, baseUnit: $baseUnit);
    }

    public function parse(string $str): Value
    {
        try {
            [$quantity, $unit] = explode(' ', $str, 2);

            return new Value(
                quantity: BigNumber::of($quantity),
                unit: $this->parseUnit($unit)
            );
        } catch (NumberFormatException $e) {
            throw new InvalidQuantityException($quantity);
        } catch (\Exception $e) {
            if (str($e->getMessage())->test('/^Undefined array key 1$/')) {
                throw new ParseException("'$str' is not a valid amount.");
            }
            throw $e;
        }
    }
}
