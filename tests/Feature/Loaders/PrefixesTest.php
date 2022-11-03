<?php

namespace Theutz\Unite\Loaders;

use Exception;
use Theutz\Unite\Definitions\PrefixDefinition;

$sut = fn () => app(Prefixes::class);

it('can be instantiated')
    ->expect($sut)
    ->not->toThrow(Exception::class);

it('loads the prefixes')
    ->expect($sut(...))->load()
    ->toBeCollection()
    ->toHaveCount(20)
    ->each->toBeInstanceOf(PrefixDefinition::class)
    ->load()
    ->firstWhere('symbol', 'k')->toEqual(new PrefixDefinition(
        symbol: 'k',
        name: 'kilo',
        factor: '1e3'
    ));
