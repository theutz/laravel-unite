<?php

namespace Theutz\Unite\Collections;

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
