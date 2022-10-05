<?php

namespace Theutz\Unite;

use Brick\Math\BigNumber;
use Brick\Math\Exception\NumberFormatException;
use Theutz\Unite\Concerns\Parser\InvalidQuantityException;
use Theutz\Unite\Concerns\Parser\InvalidUnitException;
use Theutz\Unite\Concerns\Parser\ParseException;
use Theutz\Unite\Contracts\Parser;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

/**
 * @property-read string $quantity
 * @property-read string $unit
 */
class Unite
{
    private BigNumber $quantity;

    private BaseUnit $baseUnit;

    private ?Prefix $prefix;

    public function __construct(private Parser $parser)
    {
    }

    /**
     * Primary interface for object creation
     */
    public function make(BigNumber|float|int|string $quantity, string $unit): self
    {
        $unite = new self($this->parser);

        $unite->quantity = BigNumber::of($quantity);

        $unit = $this->parser->parseUnit($unit);
        $unite->prefix = $unit->prefix;
        $unite->baseUnit = $unit->baseUnit;

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

            if (! $this->parser->isUnitValid($unit)) {
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
