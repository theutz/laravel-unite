<?php

namespace Theutz\Unite\Collections;

it('should load', function () {
    $sut = app(UnitsCollection::class);

    expect($sut)->toBeIterable();
    expect(count($sut))->toBeGreaterThanOrEqual(1);
    expect($sut->where('symbol', 'g'))->toHaveCount(1);
});
