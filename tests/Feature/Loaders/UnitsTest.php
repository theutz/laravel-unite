<?php

namespace Theutz\Unite\Loaders;

use Exception;
use Theutz\Unite\Definitions\ConversionDefinition;
use Theutz\Unite\Definitions\UnitDefinition;

$sut = fn () => app(Units::class);

it('can be instantiated')
    ->expect($sut)
    ->not->toThrow(Exception::class);

it('loads the units')
    ->expect($sut(...))->load()
    ->toBeCollection()
    ->each->toBeInstanceOf(UnitDefinition::class)
    ->load()
    ->firstWhere('symbol', 'g')
    ->toEqualCanonicalizing(new UnitDefinition(
        symbol: 'g',
        name: 'gram|grams',
        aliases: [],
        kind: 'mass',
        systems: ['si'],
        to: [new ConversionDefinition(
            symbol: 'oz',
            factor: '0.0352739907'
        )]
    ));
