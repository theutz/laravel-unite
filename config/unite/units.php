<?php

return [
    [
        'symbol' => 'g',
        'name' => 'gram|grams',
        'aliases' => [],
        'kind' => 'mass',
        'systems' => ['si'],
        'to' => [
            [
                'symbol' => 'oz',
                'factor' => '0.0352739907',
            ],
        ],
    ],
    [
        'symbol' => 'lb',
        'name' => 'pound|pounds',
        'aliases' => ['lbs'],
        'kind' => 'mass',
        'systems' => ['us', 'uk'],
        'to' => [],
    ],
    [
        'symbol' => 'oz',
        'name' => 'ounce|ounces',
        'aliases' => [],
        'kind' => 'mass',
        'systems' => ['us', 'uk'],
        'to' => [
            [
                'symbol' => 'g',
                'factor' => '2.83495e1',
            ],
        ],
    ],
    [
        'symbol' => 'ton',
        'name' => 'ton|tons',
        'aliases' => [],
        'kind' => 'mass',
        'systems' => ['us', 'uk'],
        'to' => [],
    ],
];
