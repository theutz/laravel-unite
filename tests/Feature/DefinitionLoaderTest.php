<?php

namespace Theutz\Unite;

use function Pest\Laravel\mock;
use Symfony\Component\Yaml\Yaml;
use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Definitions\UnitDefinition;

it('loads the units', function () {
    $expected = [
        [
            'symbol' => 'g',
            'name' => 'gram|grams',
            'aliases' => [],
            'kind' => 'mass',
            'systems' => ['si'],
            'to' => [],
        ],
    ];
    mock(Yaml::class)
        ->shouldReceive('parseFile')
        ->once()
        ->andReturn($expected);
    $sut = app(DefinitionLoader::class);

    $result = $sut->units();

    expect($result)->toMatchArray([UnitDefinition::make($expected[0])]);
});
