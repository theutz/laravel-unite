<?php

namespace Theutz\Unite\Collections;

use Exception;

it('can be instantiated')
    ->expect(fn () => app(Conversions::class))
    ->not->toThrow(Exception::class);

it('collects the conversions')
    ->expect(fn () => app(Conversions::class))
    ->toBeIterable();
