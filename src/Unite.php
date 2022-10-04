<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Brick\Math\Exception\NumberFormatException;
use Theutz\Unite\Exceptions\InvalidQuantityException;
use Theutz\Unite\Exceptions\InvalidUnitException;
use Theutz\Unite\Exceptions\ParseException;

/**
 * @property-read string $quantity
 * @property-read string $unit
 */
class Unite
{
    /**
     * - Must start with a word character
     * - Can only contain word characters and spaces
     *   - EXCEPT the final character, which can be 2 or 3 (to represent units of area or volume)
     */
    const VALID_UNIT = '/^\w\D*[23]?$/';

    private BigNumber $quantity;

    private mixed $unit;

    /**
     * Primary interface for object creation
     */
    public function make(BigNumber|float|int|string $quantity, string $unit): self
    {
        $unite = new self;

        $unite->quantity = BigNumber::of($quantity);
        $unite->unit = $unit;

        return $unite;
    }

    /**
     * Parses a string representation of a measurement,
     * and uses that parsed representation to instatiate.
     */
    public function parse(string $str): self
    {
        try {
            [$quantity, $unit] = explode(' ', $str, 2);

            if (! $this->isUnitValid($unit)) {
                throw new InvalidUnitException($unit);
            }

            return $this->make($quantity, $unit);
        } catch (NumberFormatException $e) {
            if (isset($quantity)) {
                throw new InvalidQuantityException($quantity);
            } else {
                throw $e;
            }
        } catch (\Exception $e) {
            if (str($e->getMessage())->test('/^Undefined array key 1$/')) {
                throw new ParseException("'$str' is not a valid amount.");
            }
            throw $e;
        }
    }

    public function isUnitValid(string $unit): bool
    {
        return preg_match($this::VALID_UNIT, $unit);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'quantity' => (string) $this->quantity,
            'unit' => $this->unit,
            default => null
        };
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit}";
    }
}
