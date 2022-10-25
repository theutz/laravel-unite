<?php

use function Pest\Laravel\mock;
use Symfony\Component\Yaml\Yaml;
use Theutz\Unite\GeneratedUnits;

it('produces the units', function () {
    config(['unite.units' => 'filename']);
    mock(Yaml::class)
        ->shouldReceive('parseFile')
        ->withSomeOfArgs('filename')
        ->once()
        ->andReturn([
            'A' => [
                'name' => 'ampere|amperes',
                'aliases' => ['amp|amps'],
            ],
        ])
        ->getMock();

    $result = app(GeneratedUnits::class)->generate();

    expect($result)->toMatchArray([
        'A' => 'ampere|amperes',
        'ampere' => 'A',
        'amperes' => 'A',
        'amp' => 'A',
        'amps' => 'A',
    ]);
});
