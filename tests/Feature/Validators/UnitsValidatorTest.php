<?php

namespace Theutz\Unite\Validators;

use Illuminate\Validation\ValidationException;

it('throws a validation exception', function ($data, $message) {
    config(['unite.units' => $data]);
    $sut = app(UnitsValidator::class);

    $action = fn () => $sut->validate();

    expect($action)->toThrow(ValidationException::class, "[laravel-unite]: Invalid Unit Config | {$message}");
})
    ->with([
        'empty array' => [[], 'The 0 field is required'],
        'missing symbol' => [[
            [
                'name' => 'gram|grams',
            ],
        ], 'The 0.symbol field is required'],
        'missing name' => [[
            [
                'symbol' => 'g',
            ],
        ], 'The 0.name field is required'],
        'missing aliases' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
            ],
        ], 'The 0.aliases field must be present'],
        'non-string alias' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [[]],
            ],
        ], 'The 0.aliases.0 must be a string'],
        'missing kind' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
            ],
        ], 'The 0.kind field is required'],
        'kind not in config' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'juniper bush',
            ],
        ], "The value 'juniper bush' at 0.kind must be one of: "],
        'missing systems' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
            ],
        ], 'The 0.systems field is required'],
        'empty systems' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => [],
            ],
        ], 'The 0.systems field is required'],
        'system not in config' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['blueberry cotton'],
            ],
        ], "The value 'blueberry cotton' at 0.systems.0 is not one of: "],
        'missing to' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['si'],
            ],
        ], 'The 0.to field must be present'],
        'conversion missing symbol' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['si'],
                'to' => [['factor' => '123']],
            ],
        ], 'The 0.to.0.symbol field is required'],
        'conversion missing factor' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['si'],
                'to' => [['symbol' => 'g']],
            ],
        ], 'The 0.to.0.factor field is required'],
        'conversion symbol not distinct' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['si'],
                'to' => [
                    ['symbol' => 'g'],
                    ['symbol' => 'g'],
                ],
            ],
        ], 'The 0.to.0.symbol field has a duplicate value'],
        'conversion symbol is invalid' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['si'],
                'to' => [[
                    'symbol' => 'blerue',
                    'factor' => '123',
                ]],
            ],
        ], "The value 'blerue' at 0.to.0.symbol must correspond to another unit in the config."],
        'conversion factor non-numeric' => [[
            [
                'symbol' => 'g',
                'name' => 'gram|grams',
                'aliases' => [],
                'kind' => 'mass',
                'systems' => ['si'],
                'to' => [[
                    'symbol' => 'g',
                    'factor' => 'blue jeans',
                ]],
            ],
        ], 'The 0.to.0.factor must be a number'],
    ]);
