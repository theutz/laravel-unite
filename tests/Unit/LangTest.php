<?php

it('does something', function () {
    $units = require __DIR__.'/../../resources/lang/en/units.php';

    expect($units)->toMatchArray([
        'kg' => 'kilogram|kilograms',
    ]);
    expect(trans_choice('unite::units.kg', 3))->toEqual('kilograms');
});
