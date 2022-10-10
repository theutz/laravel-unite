<?php

use Brick\Math\BigNumber;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Formatter\Formatter;
use Theutz\Unite\Manager\Manager;
use Theutz\Unite\Manager\ReadonlyValueException;
use Theutz\Unite\Value;

it("doesn't allow the value to be set twice", function () {
    $formatter = new Formatter;
    $manager = new Manager($formatter);
    $value = new Value(BigNumber::of(200), null, BaseUnit::Gram);

    expect(fn () => $manager->value = $value)->not->toThrow(\Exception::class);
    expect(fn () => $manager->value = $value)->toThrow(ReadonlyValueException::class);
});
