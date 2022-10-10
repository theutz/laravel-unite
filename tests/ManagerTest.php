<?php

use Brick\Math\BigNumber;
use Theutz\Unite\Formatter\Formatter;
use Theutz\Unite\Concerns\Manager\Manager;
use Theutz\Unite\Concerns\Manager\ReadonlyValueException;
use Theutz\Unite\Concerns\Value\ValueDto;
use Theutz\Unite\Enums\BaseUnit;

it("doesn't allow the value to be set twice", function () {
    $formatter = new Formatter;
    $manager = new Manager($formatter);
    $value = new ValueDto(BigNumber::of(200), null, BaseUnit::Gram);

    expect(fn () => $manager->value = $value)->not->toThrow(\Exception::class);
    expect(fn () => $manager->value = $value)->toThrow(ReadonlyValueException::class);
});
