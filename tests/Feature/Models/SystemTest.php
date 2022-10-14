<?php

use Theutz\Unite\Models\System;

it('is a singleton', function () {
    $a = app(System::class);
    $b = app(System::class);

    expect($a)->toBe($b);
});

it('can return all', function () {
    expect(System::all())->not->toBeEmpty();
});

it('can pluck ids', function () {
    expect(System::pluck('id')->all())->toContain('metric', 'imperial', 'us');
});
