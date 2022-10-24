<?php

namespace Theutz\Unite;

it('can convert', function ($from, $to, $expected) {
    $sut = app(Unite::class);
    $result = $sut->convert($from)->to($to);

    expect($result)->toBe($expected);
})->with([
    ['200 g', 'oz', '7.054798144588088 oz'],
]);
