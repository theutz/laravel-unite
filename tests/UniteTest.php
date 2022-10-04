<?php

use Brick\Math\BigDecimal;
use Theutz\Unite\Exceptions\ParseError;
use Theutz\Unite\Facades\Unite;

test('creation', function () {
    expect(Unite::make(200, 'g'))
        ->quantity->toEqual(BigDecimal::of(200))
        ->unit->toEqual('g');
});

it('parses successfully', function ($str, $quantity, $unit) {
    $result = Unite::parse($str);

    expect(Unite::parse($str))
        ->quantity->toEqual(BigDecimal::of($quantity))
        ->unit->toEqual($unit);
})->with([
    ['203 g', 203, 'g'],
    ['205g', 205, 'g'],
    ['210 km2', 210, 'km2'],
    ['187 km3', 187, 'km3'],
    ['220.3g', 220.3, 'g'],
    ['181 fl oz', 181, 'fl oz'],
]);

it('throws parse errors', function ($str) {
    Unite::parse($str);
})->throws(ParseError::class)
    ->with([
        '200 30 g',
        'g',
        '200 km4',
        '1084 g 13',
    ]);
