<?php

use Theutz\Unite\Units;

it('produces the units', function () {
    $result = app(Units::class)->generateLang();

    expect($result)->toMatchArray([
        'g' => 'gram|grams',
    ]);
});
