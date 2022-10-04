<?php

use Theutz\Unite\Exceptions\InvalidQuantityException;
use Theutz\Unite\Exceptions\InvalidUnitException;
use Theutz\Unite\Exceptions\ParseException;
use Theutz\Unite\Facades\Unite;

it('successfully creates', function ($quantity, $unit) {
    expect(Unite::make($quantity, $unit))
        ->quantity->toEqual($quantity)
        ->unit->toEqual($unit);
})
    ->with([
        [200, 'g'],
        ['1/3', 'lb'],
        [4.034e20, 'kg'],
    ]);

it('successfully parses', function ($str, $quantity, $unit) {
    expect(Unite::parse($str))
        ->quantity->toEqual($quantity)
        ->unit->toEqual($unit);
})->with([
    ['203 g', 203, 'g'],
    ['210 km2', 210, 'km2'],
    ['187 km3', 187, 'km3'],
    ['220.3 g', 220.3, 'g'],
    ['181 fl oz', 181, 'fl oz'],
    ['2.5e10 cm3', 2.5e10, 'cm3'],
    ['2.5E10 cm3', 2.5e10, 'cm3'],
    ['2.4e-10 km2', 2.4E-10, 'km2'],
]);

it('throws invalid unit exceptions', function ($str) {
    Unite::parse($str);
})->throws(InvalidUnitException::class)
    ->with([
        '200 30 g',
        '200 km4',
        '1084 g 13',
    ]);

it('throws invalid quantity exceptions', function ($str) {
    Unite::parse($str);
})->throws(InvalidQuantityException::class)
    ->with([
        '2.4-10 km2',
    ]);

it('throws when there are no spaces', function ($str) {
    Unite::parse($str);
})
    ->throws(ParseException::class)
    ->with([
        '205g',
        'g',
    ]);
