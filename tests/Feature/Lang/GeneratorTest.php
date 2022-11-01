<?php

namespace Theutz\Unite\Lang;

beforeEach(fn () => $this->sut = app(Generator::class));

$sut = fn () => $this->sut;

it('should generate symbol to name map')
    ->expect($sut)
    ->symbolsToNames()
    ->toMatchArray([
        'g' => 'gram|grams',
        'kg' => 'kilogram|kilograms',
    ]);

it('should generate a names to symbol map')
    ->expect($sut)
    ->namesToSymbols()
    ->toMatchArray([
        'gram' => 'g',
        'grams' => 'g',
    ]);
