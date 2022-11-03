<?php

namespace Theutz\Unite\Validators;

use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->setConfig = fn ($val) => config(['unite.prefixes' => $val]);
    $this->action = fn () => app(PrefixesValidator::class)->validate();
});

it('throws a validation exception', function ($data, $message) {
    config(['unite.prefixes' => $data]);

    expect(fn () => app(PrefixesValidator::class)->validate())
        ->toThrow(ValidationException::class, "[laravel-unite]: Invalid Prefix Config | {$message}");
})
    ->with([
        'empty array' => [[], 'The 0 field is required'],
        'missing symbol' => [[
            ['name' => 'kilo'],
        ], 'The 0.symbol field is required'],
        'missing name' => [[
            ['symbol' => 'k'],
        ], 'The 0.name field is required'],
        'indistinct symbol' => [[
            ['symbol' => 'k'], ['symbol' => 'k'],
        ], 'The 0.symbol field has a duplicate value'],
        'indistinct name' => [[
            ['symbol' => 'k', 'name' => 'kilo'],
            ['symbol' => 'm', 'name' => 'kilo'],
        ], 'The 0.name field has a duplicate value'],
        'missing factor' => [[
            ['name' => 'k', 'symbol' => 'k'],
        ], 'The 0.factor field is required'],
        'indistinct factor' => [[
            ['symbol' => 'k', 'name' => 'kilo', 'factor' => '1e3'],
            ['symbol' => 'm', 'name' => 'milli', 'factor' => '1e3'],
        ], 'The 0.factor field has a duplicate value'],
        'non-numeric factor' => [[
            ['symbol' => 'k', 'name' => 'kilo', 'factor' => 'blue jeans'],
        ], 'The 0.factor must be a number'],
    ]);
