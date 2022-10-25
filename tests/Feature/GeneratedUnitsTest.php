<?php

use Illuminate\Support\Facades\Config;
use Theutz\Unite\GeneratedUnits;

it('works', function () {
    Config::shouldReceive('get')
        ->withSomeOfArgs('unite.units')
        ->andReturn(['A' => 'ampere|amperes;;amp|amps']);

    $result = app(GeneratedUnits::class)->generate();

    expect($result)->toEqual([
        'A' => 'ampere|amperes',
        'ampere' => 'A',
        'amperes' => 'A',
        'amp' => 'A',
        'amps' => 'A',
    ]);
});
