<?php

namespace Theutz\Unite;

use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Definitions\PrefixDefinition;
use Theutz\Unite\Definitions\UnitDefinition;

beforeEach(function () {
    $this->sut = app(DefinitionLoader::class);
});

it('loads the units', function () {
    $result = $this->sut->units();

    expect($result->firstWhere('symbol', 'g'))->toEqual(
        new UnitDefinition(
            symbol: 'g',
            name: 'gram|grams',
            aliases: [],
            kind: 'mass',
            systems: ['si'],
            to: ['oz' => '0.0352739907']
        )
    );
});

it('loads the prefixes', function () {
    $result = $this->sut->prefixes();

    expect($result->firstWhere('symbol', 'k'))->toEqual(
        new PrefixDefinition(
            symbol: 'k',
            name: 'kilo',
            factor: '1e3'
        )
    );
});
