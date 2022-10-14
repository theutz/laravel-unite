<?php

use Theutz\Unite\Models\Kind;

it('is a singleton', function () {
    $a = app(Kind::class);
    $b = app(Kind::class);

    expect($a)->toBe($b);
});

it('can return all', function () {
    expect(Kind::all())->not->toBeEmpty();
});

it('can pluck ids', function () {
    expect(Kind::pluck('id')->all())->toContain('mass', 'length');
});
