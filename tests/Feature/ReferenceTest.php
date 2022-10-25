<?php

namespace Theutz\Unite;

use Illuminate\Support\Facades\Config;

beforeEach(function () {
    $this->config = Config::getFacadeRoot();

    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.units')
        ->andReturn([
            'g' => 'mass',
            'oz' => 'mass',
        ]);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.unit-to-systems')
        ->andReturn([
            'g' => 'si',
            'oz' => 'us,uk',
        ]);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.conversions')
        ->andReturn([
            'g -> oz' => 3,
            'oz -> g' => 1 / 3,
        ]);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.systems')
        ->andReturn(['si', 'us', 'uk']);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.kinds')
        ->andReturn(['mass']);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.prefixes')
        ->andReturn(['k' => 3]);

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
        'unit-has-prefixes',
        'unit-to-systems',
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
        [
            'id' => 'oz',
            'kind' => 'mass',
            'systems' => collect(['us', 'uk']),
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

it('returns systems', function () {
    $result = $this->sut->systems();

    expect($result)->toEqual(collect(['si', 'us', 'uk']));
});

it('returns kinds', function () {
    $result = $this->sut->kinds();

    expect($result)->toEqual(collect(['mass']));
});

it('returns prefixes', function () {
    $result = $this->sut->prefixes();

    expect($result)->toEqual(collect([
        ['id' => 'k', 'magnitude' => 3],
    ]));
});

it('returns unit-to-systems', function () {
    $result = $this->sut->unitToSystems();

    expect($result)->toEqual(collect([
        'g' => collect(['si']),
        'oz' => collect(['us', 'uk']),
    ]));
});
