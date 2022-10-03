<?php

use Theutz\Unite\Facades\Unite;
use Theutz\Unite\Exceptions\ParseError;

test('creation', function () {
    expect(Unite::make(200, 'g'))->toEqual('200 g');
});

it('parses successfully', function ($str, $expected) {
    $result = Unite::parse($str);
    expect((string) $result)->toEqual($expected);
})
->with([
    ['200 g', '200 g'],
    ['200g', '200 g'],
    ['200 km2', '200 km2'],
    ['200 km3', '200 km3'],
    ['200.3g', '200.3 g'],
    ['200 fl oz', '200 fl oz'],
]);

test('parse errors', function ($str) {
    Unite::parse($str);
})
->throws(ParseError::class)
->with([
    '200 30 g',
    'g',
    '200 km4'
]);
