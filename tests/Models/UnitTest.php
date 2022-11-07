<?php

use Illuminate\Database\Eloquent\Model;
use Theutz\Unite\Models\Unit;

it('can be instantiated')
    ->expect(fn () => app(\Theutz\Unite\Models\Unit::class))
    ->toBeInstanceOf(Model::class);

it('has one')
    ->expect(fn () => Unit::firstWhere('symbol', 'g'))
    ->symbol->toBe('g');
