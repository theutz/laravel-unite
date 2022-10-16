<?php

use Theutz\Unite\Parser\ParseException;
use Theutz\Unite\Parser\Parser;
use Theutz\Unite\Parser\QuantityParseException;
use Theutz\Unite\Parser\UnitParseException;

it('can split the quantity and unit', function ($string, $expected) {
    $sut = app(Parser::class);
    $result = $sut->splitQuantityAndUnit($string);
    expect($result)->toEqual($expected);
})
    ->with([
        ['200 g', ['200', 'g']],
        ['1,508 grams', ['1,508', 'grams']],
        ['1.480e-10 cubit poops', ['1.480e-10', 'cubit poops']],
    ]);

it('can split the unit and prefix', function ($string, $expected) {
    $sut = app(Parser::class);
    $result = $sut->splitPrefixAndUnit($string);
    expect($result)->toEqual($expected);
})
    ->with([
        ['kg', ['k', 'g']],
        ['oz', [null, 'oz']],
    ]);

it('throws with junk data', function ($string) {
    $sut = app(Parser::class);
    $action = fn () => $sut->splitQuantityAndUnit($string);
    expect($action)->toThrow(ParseException::class);
})
    ->with([
        '1bw280',
    ]);

it('throws with invalid quantity', function ($string) {
    $sut = app(Parser::class);
    $action = fn () => $sut->parseQuantity($string);
    expect($action)->toThrow(QuantityParseException::class);
})
    ->with([
        'e10 g',
    ]);

it('can parse the unit', function ($str, $expected) {
    $sut = app(Parser::class);
    $result = $sut->parseUnit($str);
    expect($result)->toEqual($expected);
})
    ->with([
        ['kg', 'g'],
        ['oz', 'oz'],
    ]);

it('throws a UnitParseException', function ($str) {
    $sut = app(Parser::class);
    $action = fn () => $sut->splitPrefixAndUnit($str);
    expect($action)->toThrow(UnitParseException::class);
})
    ->with(['kbz']);
