<?php

namespace Theutz\Unite\Loaders;

use Exception;
use Theutz\Unite\Definitions\Unit;

$sut = fn () => app(Units::class);

it('can be instantiated')
    ->expect($sut)
    ->not->toThrow(Exception::class);

it('loads the units')
    ->expect($sut(...))->load()
    ->toBeCollection()
    ->each->toBeInstanceOf(Unit::class)
    ->load()
    ->firstWhere('symbol', 'g')
    ->toEqualCanonicalizing(new Unit(
        symbol: 'g',
        name: 'gram|grams',
        aliases: [],
        kind: 'mass',
        systems: ['si'],
    ));
