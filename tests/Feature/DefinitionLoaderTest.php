<?php

namespace Theutz\Unite;

use function Pest\Laravel\mock;
use Symfony\Component\Yaml\Yaml;
use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Definitions\UnitDefinition;

it('loads the units', function () {
    $sut = app(DefinitionLoader::class);

    $result = $sut->units();

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
