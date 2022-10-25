<?php

namespace Theutz\Unite;

use function Pest\Laravel\mock;
use Symfony\Component\Yaml\Yaml;

it('loads the units', function () {
    $expected = ['g' => ['name' => 'gram|grams']];
    mock(Yaml::class)
        ->shouldReceive('parseFile')
        ->once()
        ->andReturn($expected);
    $sut = app(Loader::class);

    $result = $sut->units();

    expect($result)->toMatchArray($expected);
});
