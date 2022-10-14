<?php

use Theutz\Unite\Parser\Parser;

it('can be instantiated', function () {
    expect(fn () => app(Parser::class))->not->toThrow(\Exception::class);
    $this->assertTrue(true);
});

it('can split the quantity and unit', function ($string, $expected) {
    $sut = app(Parser::class);
    $result = $sut->splitQuantityAndUnit($string);
    expect($result)->toEqual($expected);
})->with([
    ['200 g', ['200', 'g']],
    ['1,508 grams', ['1,508', 'grams']],
    ['1.480e-10 cubit poops', ['1.480e-10', 'cubit poops']]
]);

it('can split the unit and prefix', function ($string, $expected) {
    $sut = app(Parser::class);
    $result = $sut->splitPrefixAndUnit($string);
    expect($result)->toEqual($expected);
})->with([
    ['kg', ['k', 'g']],
    ['oz', [null, 'oz']]
]);
