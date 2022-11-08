<?php

use Theutz\Unite\Parsers\Parser;

it('can be instantiated')
    ->expect(fn () => app(Parser::class))
    ->toBeInstanceOf(Parser::class);

it('can parse', function ($string, $expected) {
    $sut = app(Parser::class);

    $result = $sut->parse($string);

    expect($result)->toEqualCanonicalizing($expected);
})
    ->with([
        ['200 km', [
            'quantity' => '200', 'prefix' => 'k', 'unit' => 'm',
        ]],
    ]);
