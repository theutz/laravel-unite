<?php

namespace Theutz\Unite\Validators;

use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->setConfig = fn ($val) => config(['unite.units' => $val]);
    $this->action = fn () => app(UnitsValidator::class)->validate();
});

it('throws a validation exception', function ($data, $message) {
    config(['unite.units' => $data]);

    expect(fn () => app(UnitsValidator::class)->validate())
        ->toThrow(ValidationException::class, $message);
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
        ], 'The selected 0.kind is invalid'],
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
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['bluberry cotton']],
        ], 'The selected 0.systems.0 is invalid'],
        'missing to' => [[
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['si']],
        ], 'The 0.to field must be present'],
        'conversion missing symbol' => [[
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['si'], 'to' => [['factor' => '123']]],
        ], 'The 0.to.0.symbol field is required'],
        'conversion missing factor' => [[
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['si'], 'to' => [['symbol' => 'g']]],
        ], 'The 0.to.0.factor field is required'],
        'conversion symbol not distinct' => [[
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['si'], 'to' => [['symbol' => 'g'], ['symbol' => 'g']]],
        ], 'The 0.to.0.symbol field has a duplicate value'],
        'conversion symbol is invalid' => [[
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['si'], 'to' => [['symbol' => 'blerue', 'factor' => '123']]],
        ], 'The selected 0.to.0.symbol is invalid'],
        'conversion factor non-numeric' => [[
            ['symbol' => 'g', 'name' => 'gram|grams', 'aliases' => [], 'kind' => 'mass', 'systems' => ['si'], 'to' => [['symbol' => 'g', 'factor' => 'blue jeans']]],
        ], 'The 0.to.0.factor must be a number'],
    ]);
