<?php

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Formatter\Formatter;
use Theutz\Unite\Concerns\Manager\Manager;
use Theutz\Unite\Concerns\Manager\ReadonlyValueException;
use Theutz\Unite\DTOs\Unit;
use Theutz\Unite\DTOs\Value;
use Theutz\Unite\Enums\BaseUnit;

it("doesn't allow the value to be set twice", function () {
    $formatter = new Formatter;
    $manager = new Manager($formatter);
    $unit = new Unit(null, BaseUnit::Gram);
    $value = new Value(BigNumber::of(200), $unit);

    expect(fn () => $manager->setValue($value))->not->toThrow(\Exception::class);
    expect(fn () => $manager->setValue($value))->toThrow(ReadonlyValueException::class);
});
