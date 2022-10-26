<?php

namespace Theutz\Unite\Collections;

use Theutz\Unite\Definitions\ConversionDefinition;
use Theutz\Unite\Definitions\UnitDefinition;

beforeEach(fn () => $this->sut = app(UnitsCollection::class));

$sut = fn () => $this->sut;

it('should be iterable')
    ->expect($sut)
    ->toBeIterable();

it('should be countable')
    ->expect(fn () => count($this->sut))
    ->toBeGreaterThanOrEqual(1);

it('should be a collection of unit definitions')
    ->expect($sut)
    ->where('symbol', 'g')
    ->sole()
    ->toBeInstanceOf(UnitDefinition::class);

it('should generate prefixed units')
    ->expect($sut)
    ->where('symbol', 'kg')
    ->first()
    ->toMatchObject((object) [
        'symbol' => 'kg',
        'name' => 'kilogram|kilograms',
        'aliases' => collect(),
        'kind' => 'mass',
        'to' => collect([
            new ConversionDefinition(
                symbol: 'oz',
                factor: '35.2739907'
            ),
        ]),
    ]);

// it('should generate lang entries')
//     ->expect($sut);
