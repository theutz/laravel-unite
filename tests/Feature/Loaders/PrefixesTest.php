<?php

namespace Theutz\Unite\Loaders;

use Exception;
use Theutz\Unite\Definitions\Prefix;

$sut = fn () => app(Prefixes::class);

it('can be instantiated')
    ->expect($sut)
    ->not->toThrow(Exception::class);

it('loads the prefixes')
    ->expect($sut(...))->load()
    ->toBeCollection()
    ->toHaveCount(20)
    ->each->toBeInstanceOf(Prefix::class)
    ->load()
    ->firstWhere('symbol', 'k')->toEqual(new Prefix(
        symbol: 'k',
        name: 'kilo',
        factor: '1e3'
    ));
