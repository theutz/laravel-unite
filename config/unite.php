<?php

/**
 * Config for laravel-unite
 */
return [

    /**
     * A list of the various kinds of physical quantities that can be
     * represented. these values represent keys used in further configuration
     * collections, as well as translation keys.
     */
    'kinds' => [
        'mass',
        'length',
        'area',
        'volume',
        'time',
        'temperature',
        'electricity',
        'pressure',
        'light',
        'force',
        'power',
    ],

    /**
     * A list of supported measurement systems. These values also represent
     * keys used in further configuration collections and translation keys.
     */
    'systems' => [
        'si', // Metric System (International System of Units)
        'us', // United States Customary System
        'uk', // British Imperial System
    ],

    /**
     * A list of unit prefixes and their corresponding factors., generally
     * used in the metric system.
     *
     * The keys represent the internationally accepted abbreviation for the
     * prefix, as well as the translation key for the prefix.
     *
     * The value represents the power of 10 by which to multiply the base unit
     * when the prefix is present.
     */
    'prefixes' => [
        'Y' => 24,
        'Z' => 21,
        'E' => 18,
        'P' => 15,
        'T' => 12,
        'G' => 9,
        'M' => 6,
        'k' => 3,
        'h' => 2,
        'da' => 1,
        'd' => -1,
        'c' => -2,
        'm' => -6,
        'μ' => -9,
        'n' => -12,
        'p' => -15,
        'f' => -18,
        'a' => -21,
        'z' => -24,
        'y' => -24,
    ],

    /**
     * A list of units and their corresponding kind from the `kinds` config
     * array.
     */
    'units' => [
        'A' => 'electricity',
        'acre' => 'area',
        'bar' => 'pressure',
        'C' => 'temperature',
        'cd' => 'light',
        'ch' => 'length',
        'cu ft' => 'volume',
        'cu in' => 'volume',
        'cu mi' => 'volume',
        'cu yd' => 'volume',
        'd' => 'time',
        'dry pt' => 'volume',
        'dry qt' => 'volume',
        'F' => 'temperature',
        'fl oz' => 'volume',
        'ft' => 'length',
        'fur' => 'length',
        'g' => 'mass',
        'gal' => 'volume',
        'gil' => 'volume',
        'h' => 'time',
        'in' => 'length',
        'K' => 'temperature',
        'L' => 'volume',
        'lb' => 'mass',
        'lea' => 'length',
        'long ton' => 'mass',
        'm' => 'length',
        'm2' => 'area',
        'm3' => 'volume',
        'mi' => 'length',
        'min' => 'time',
        'mmHg' => 'pressure',
        'N' => 'force',
        'oz' => 'mass',
        'pt' => 'volume',
        'qt' => 'volume',
        'rad' => 'angle',
        's' => 'time',
        'sq ft' => 'area',
        'sq in' => 'area',
        'sq mi' => 'area',
        'sq yd' => 'area',
        'st' => 'volume',
        'tbsp' => 'volume',
        'ton' => 'mass',
        'tsp' => 'volume',
        'V' => 'electricity',
        'W' => 'power',
        'yd' => 'length',
    ],

    /**
     * A map between units and a comma-separated list of measurement systems to which
     * they belong.
     */
    'unit-belongs-to-systems' => [
        'acre' => 'uk,us',
        'g' => 'si',
        'm2' => 'si',
        'oz' => 'us,uk',
    ],

    /**
     * A list of the units that should expect metric prefixes. This list is used
     * to generate values in language files.
     *
     * By default, all units in the Metric system will have prefixes
     * generated.
     */
    'unit-has-prefixes' => [],

    /**
     * A list of conversion factors/formulas between units.
     *
     * The key is an arrow-separated representation of the units we're converting
     * from and to, i.e., `{from} -> {to}`.
     *
     * If the value is numeric, it represents a linear factor to multiply the
     * `from` value by in order to convert to the `to` unit.
     *
     * If the value is a string, it representts a formula to apply to the `from`
     * value to arrive at the `to` unit. The `from` value is represented by `x`.
     */
    'unit-converts-to' => [
        'acre -> m2' => 4.046873e3,
        'C -> F' => '(x * 1.8) + 32',
        'F -> C' => '(x - 32) / 1.8',
        'g -> oz' => 3.52739907e-2,
        'm2 -> acre' => 2.471054e-4,
        'oz -> g' => 2.83495e1,
    ],

    /**
     * A list of default units by system and kind.
     *
     * The keys are a dash-separated concatenation of the measurement system and
     * the measurement kind, i.e., `{system} > {kind}`.
     *
     * The values should correlate to a key from the `units` config.
     */
    'default-unit-for-system-and-kind' => [
        'metric > mass' => 'g',
    ],
];
