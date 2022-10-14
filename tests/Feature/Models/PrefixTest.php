<?php

use Theutz\Unite\Models\Prefix;

it('is a singleton', function () {
    $a = app(Prefix::class);
    $b = app(Prefix::class);

    expect($a)->toBe($b);
});

it('can return all', function () {
    expect(Prefix::all())->not->toBeEmpty();
});

it('can pluck ids', function () {
    expect(Prefix::pluck('id')->all())->toContain('kilo', 'deka', 'yotta');
    expect(Prefix::pluck('abbr')->all())->toContain('k', 'd', 'Y');
});
