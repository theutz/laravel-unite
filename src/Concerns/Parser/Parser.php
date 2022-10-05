<?php

namespace Theutz\Unite\Concerns\Parser;

use Theutz\Unite\Contracts\Parser as Contract;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;
use Theutz\Unite\Unit;
use Theutz\Unite\Value;

class Parser implements Contract
{
    /**
     * - Must start with a word character
     * - Can only contain word characters and spaces
     *   - EXCEPT the final character, which can be 2 or 3 (to represent units of area or volume)
     */
    const VALID_UNIT = '/^\w\D*[23]?$/';

    public function parse(string $str): Value
    {
    }

    public function isUnitValid(string $unit): bool
    {
        return preg_match($this::VALID_UNIT, $unit);
    }

    public function parseUnit(string $unit): Unit
    {
        $unit = str($unit);

        if (! is_null($baseUnit = BaseUnit::tryFrom($unit))) {
            return new Unit(prefix: null, baseUnit: $baseUnit);
        }

        try {
            $baseUnit = collect(BaseUnit::cases())
                ->firstOrFail(fn ($u) => $unit->endsWith($u->value));
            $prefix = collect(Prefix::cases())
                ->firstOrFail(fn ($p) => $unit->startsWith($p->value));
        } catch (\Exception $e) {
            throw new InvalidUnitException($unit);
        }

        return new Unit(prefix: $prefix, baseUnit:$baseUnit);
    }
}
