<?php

namespace Theutz\Unite;

use Illuminate\Support\Facades\Config;

beforeEach(function () {
    $this->config = Config::getFacadeRoot();

    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.units')
        ->andReturn(['g' => 'mass']);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.unit-belongs-to-systems')
        ->andReturn(['g' => 'si']);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.conversions')
        ->andReturn(['g -> oz' => 3, 'oz -> g' => 1 / 3]);

    $this->sut = app(Reference::class);
});

test('config has key', function ($key) {
    Config::swap($this->config);
    $result = $this->sut->config($key);

    expect($result)->toBeArray();
})
    ->with([
        'units',
        'prefixes',
        'systems',
        'kinds',
        'default-unit-for-system-and-kind',
        'unit-has-prefixes',
        'unit-belongs-to-systems',
        'conversions',
    ]);

it('returns units', function () {
    $result = $this->sut->units();

    expect($result)->toEqual(collect([
        [
            'id' => 'g',
            'kind' => 'mass',
            'systems' => collect(['si']),
        ],
    ]));
});

it('returns conversions', function () {
    $result = $this->sut->conversions();

    expect($result)->toEqual(collect([
        ['from' => 'g', 'to' => 'oz', 'factor' => 3],
        ['from' => 'oz', 'to' => 'g', 'factor' => 1 / 3],
    ]));
});
