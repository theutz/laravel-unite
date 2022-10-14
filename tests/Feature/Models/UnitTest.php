<?php

use Theutz\Unite\Models\Unit;

it('is a singleton', function () {
    $a = app(Unit::class);
    $b = app(Unit::class);

    expect($a)->toBe($b);
});

it('can return all', function () {
    expect(Unit::all())->not->toBeEmpty();
});

it('can pluck ids', function () {
    expect(Unit::pluck('id')->all())->toContain('g', 'oz');
});
