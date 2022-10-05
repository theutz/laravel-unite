<?php

namespace Theutz\Unite\Concerns\Parser;

use Theutz\Unite\Contracts\Parser as Contract;
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
}
