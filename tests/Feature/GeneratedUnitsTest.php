<?php

use Theutz\Unite\GeneratedUnits;

it('produces the units', function () {
    config(['unite.units' => ['A' => 'ampere|amperes;;amp|amps']]);

    $result = app(GeneratedUnits::class)->generate();

    expect($result)->toEqual([
        'A' => 'ampere|amperes',
        'ampere' => 'A',
        'amperes' => 'A',
        'amp' => 'A',
        'amps' => 'A',
    ]);
});
