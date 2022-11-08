<?php

use Theutz\Unite\Unite;

it('can be instantiated')
    ->expect(fn () => app(Unite::class))
    ->toBeInstanceOf(Unite::class);
