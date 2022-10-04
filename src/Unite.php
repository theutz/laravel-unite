<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Brick\Math\Exception\NumberFormatException;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;
use Theutz\Unite\Enums\System;
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

    private BaseUnit $baseUnit;

    private ?Prefix $prefix;

    private System $system = System::SI;

    /**
     * @return array{0: Enums\Prefix|null, 1: Enums\BaseUnit}
     */
    private static function parseUnit(string $unit): array
    {
        $unit = str($unit);

        if (! is_null($baseUnit = BaseUnit::tryFrom($unit))) {
            return [null, $baseUnit];
        }

        try {
            $baseUnit = collect(BaseUnit::cases())
                ->firstOrFail(fn ($u) => $unit->endsWith($u->value));
            $prefix = collect(Prefix::cases())
                ->firstOrFail(fn ($p) => $unit->startsWith($p->value));
        } catch (\Exception $e) {
            throw new InvalidUnitException($unit);
        }

        return [$prefix, $baseUnit];
    }

    /**
     * Primary interface for object creation
     */
    public function make(BigNumber|float|int|string $quantity, string $unit): self
    {
        $unite = new self;

        $unite->quantity = BigNumber::of($quantity);

        [$prefix, $baseUnit] = self::parseUnit($unit);
        $unite->prefix = $prefix;
        $unite->baseUnit = $baseUnit;

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
            'unit' => "{$this->prefix?->value}{$this->baseUnit->value}",
            default => null
        };
    }

    public function __toString(): string
    {
        return "{$this->quantity} {$this->unit}";
    }
}
