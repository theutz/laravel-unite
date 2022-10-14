<?php

use Theutz\Unite\Parser\Parser;

it('can be instantiated', function () {
    expect(fn () => app(Parser::class))->not->toThrow(\Exception::class);
    $this->assertTrue(true);
});

it('can separate the quantity from the unit', function ($string, $expected) {
    $result = app(Parser::class)->splitQuantityAndUnit($string);

    expect($result)->toEqual($expected);
})->with([
    ['200 g', ['200', 'g']],
    ['1,508 grams', ['1,508', 'grams']],
    ['1.480e-10 cubit poops', ['1.480e-10', 'cubit poops']]
]);
