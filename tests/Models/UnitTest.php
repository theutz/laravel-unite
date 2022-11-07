<?php

use Illuminate\Database\Eloquent\Model;

it('can be instantiated')
    ->expect(fn () => app(\Theutz\Unite\Models\Unit::class))
    ->toBeInstanceOf(Model::class);
