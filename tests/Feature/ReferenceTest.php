<?php

namespace Theutz\Unite;

use Illuminate\Support\Facades\Config;

beforeEach(function () {
    $this->sut = app(Reference::class);
});

it('can be instantiated', function () {
    expect(fn () => app(Reference::class))->not->toThrow(\Exception::class);
    expect($this->sut)->toBeObject();
});

test('config has key', function ($key) {
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
        'unit-converts-to',
    ]);

it('returns units', function () {
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.units')
        ->andReturn(['g' => 'mass']);
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.unit-belongs-to-systems')
        ->andReturn(['g' => 'si']);

    $result = $this->sut->units();

    expect($result)->toEqual(collect([
        [
            'id' => 'g',
            'kind' => 'mass',
            'systems' => collect(['si']),
        ],
    ]));
});
