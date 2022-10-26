<?php

namespace Theutz\Unite\Collections;

use Theutz\Unite\Definitions\ConversionDefinition;
use Theutz\Unite\Definitions\UnitDefinition;

beforeEach(fn () => $this->sut = app(UnitsCollection::class));

it('should be iterable')
    ->expect(fn () => $this->sut)
    ->toBeIterable();

it('should be countable')
    ->expect(fn () => count($this->sut))
    ->toBeGreaterThanOrEqual(1);

it('should be a collection of unit definitions')
    ->expect(fn () => $this->sut)
    ->where('symbol', 'g')
    ->sole()
    ->toBeInstanceOf(UnitDefinition::class);

it('should generate prefixed units')
    ->expect(fn () => $this->sut)
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
