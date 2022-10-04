<?php

use Theutz\Unite\Exceptions\ParseError;
use Theutz\Unite\Facades\Unite;

test('`make` method', function ($quantity, $unit) {
    expect(Unite::make($quantity, $unit))
        ->quantity->toEqual($quantity)
        ->unit->toEqual($unit);
})
    ->with([
        [200, 'g'],
        ['1/3', 'lb'],
        [4.034e20, 'kg'],
    ]);

test('`parse` method', function ($str, $quantity, $unit) {
    expect(Unite::parse($str))
        ->quantity->toEqual($quantity)
        ->unit->toEqual($unit);
})->with([
    ['203 g', 203, 'g'],
    ['205g', 205, 'g'],
    ['210 km2', 210, 'km2'],
    ['187 km3', 187, 'km3'],
    ['220.3g', 220.3, 'g'],
    ['181 fl oz', 181, 'fl oz'],
]);

it('throws parse errors')
    ->with([
        '200 30 g',
        'g',
        '200 km4',
        '1084 g 13',
    ])
    ->expect(fn ($str) => Unite::parse($str))->throws(ParseError::class);

