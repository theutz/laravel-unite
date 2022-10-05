<?php

use Theutz\Unite\Concerns\Parser\InvalidBaseUnitException;
use Theutz\Unite\Concerns\Parser\InvalidQuantityException;
use Theutz\Unite\Concerns\Parser\InvalidUnitPrefixException;
use Theutz\Unite\Concerns\Parser\ParseException;
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

it('can be cast to string', function ($str) {
    expect(Unite::parse($str))->toEqual($str);
})->with([
    '200 g',
]);

it('throws invalid base unit exceptions', function ($str) {
    Unite::parse($str);
})->throws(InvalidBaseUnitException::class)
    ->with([
        '200 km4',
        '1084 g 13',
        '100 kIo',
        '30 fl ozy',
    ]);

it('throws invalid unit prefix exceptions', function ($str) {
    Unite::parse($str);
})->throws(InvalidUnitPrefixException::class)
    ->with([
        '200 30 g',
        '100 wg',
        '20 fl ozs',
        '20 floz',
        '20 3oz',
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
