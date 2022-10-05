<?php

use Brick\Math\BigNumber;
use Theutz\Unite\Concerns\Formatter\Formatter;
use Theutz\Unite\Concerns\Unit\UnitDto;
use Theutz\Unite\DTOs\Value;
use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Prefix;

beforeEach(function () {
    $this->sut = new Formatter;
    $this->quantity = BigNumber::of(200);
    $this->prefix = Prefix::Kilo;
    $this->baseUnit = BaseUnit::Gram;
    $this->unit = new UnitDto($this->prefix, $this->baseUnit);
    $this->value = new Value($this->quantity, $this->unit);
});

it('formats the value', function () {
    expect($this->sut->value($this->value))->toEqual('200 kg');
});

it('formats the quantity', function () {
    expect($this->sut->quantity($this->value))->toEqual(200);
});

it('formats the unit', function () {
    expect($this->sut->unit($this->value))->toEqual('kg');
});

it('formats the base unit', function () {
    expect($this->sut->baseUnit($this->value))->toEqual('g');
});

it('formats the prefix', function () {
    expect($this->sut->prefix($this->value))->toEqual('k');
});
