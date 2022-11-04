<?php

namespace Theutz\Unite\Values;

use Exception;
use Theutz\Unite\Definitions\Prefix as PrefixDefinition;
use Theutz\Unite\Definitions\Unit as UnitDefinition;

$unitDef = new UnitDefinition(
    symbol: 'g',
    name: 'gram|grams',
    kind: 'mass',
    aliases: [],
    systems: ['si'],
    isPrefixable: true,
);

$prefixDef = new PrefixDefinition(
    symbol: 'k',
    name: 'kilo',
    factor: '1e3'
);

$prefix = new Prefix($prefixDef);

it('can be instantiated')
    ->expect(fn () => Unit::make($unitDef))
    ->not->toThrow(Exception::class);

it('can clone a prefix')
    ->expect(fn () => Unit::make($unitDef)->withPrefix($prefix))
    ->symbol->toBe('kg')
    ->name->toBe('kilogram|kilograms');
