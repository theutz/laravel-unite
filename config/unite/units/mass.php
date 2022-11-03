<?php

use Theutz\Unite\Definitions\Unit;

return [
    new Unit(
        symbol: 'g',
        name: 'gram|grams',
        aliases: [],
        kind: 'mass',
        systems: ['si']
    ),
    new Unit(
        symbol: 'lb',
        name: 'pound|pounds',
        aliases: ['lbs'],
        kind: 'mass',
        systems: ['us', 'uk']
    ),
    new Unit(
        symbol: 'oz',
        name: 'ounce|ounces',
        aliases: [],
        kind: 'mass',
        systems: ['us', 'uk']
    ),
    new Unit(
        symbol: 'ton',
        name: 'ton|tons',
        aliases: [],
        kind: 'mass',
        systems: ['us', 'uk']
    ),
];
