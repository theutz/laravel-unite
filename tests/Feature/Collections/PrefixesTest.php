<?php

namespace Theutz\Unite\Collections;

use Exception;
use Theutz\Unite\Values\Prefix;

it('can be instantiated')
    ->expect(fn () => app(Prefixes::class))
    ->not->toThrow(Exception::class);

it('collects the prefixes')
    ->expect(fn () => app(Prefixes::class))
    ->toBeIterable()
    ->each->toBeInstanceOf(Prefix::class);
