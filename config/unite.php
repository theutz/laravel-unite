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
     * A list of units and their corresponding singular names
     */
    'units' => [
        'A' => 'ampere',
        'acre' => 'acre',
        'bar' => 'bar',
        'C' => 'Celsius',
        'cd' => 'candela',
        'ch' => 'chain',
        'cu ft' => 'cubic feet',
        'cu in' => 'cubic inch',
        'cu mi' => 'cubic mile',
        'cu yd' => 'cubic yard',
        'd' => 'day',
        'dry pt' => 'dry pint',
        'dry qt' => 'dry quart',
        'F' => 'Fahrenheit',
        'fl oz' => 'fluid ounce',
        'ft' => 'foot',
        'fur' => 'furlong',
        'g' => 'gram',
        'gal' => 'gallon',
        'gil' => 'gill',
        'h' => 'hour',
        'in' => 'inch',
        'K' => 'Kelvin',
        'L' => 'liter',
        'lb' => 'pound',
        'lea' => 'league',
        'long ton' => 'long ton',
        'm' => 'meter',
        'm2' => 'meter squared',
        'm3' => 'meter cubed',
        'mi' => 'mile',
        'min' => 'minute',
        'mmHg' => 'millimeter of mercury',
        'N' => 'Newton',
        'oz' => 'ounce',
        'pt' => 'pint',
        'qt' => 'quart',
        'rad' => 'radian',
        's' => 'second',
        'sq ft' => 'square foot',
        'sq in' => 'square inch',
        'sq mi' => 'square mile',
        'sq yd' => 'square yard',
        'st' => 'stere',
        'tbsp' => 'tablespoon',
        'ton' => 'ton',
        'tsp' => 'teaspoon',
        'V' => 'volt',
        'W' => 'watt',
        'yd' => 'yard',
    ],

    /**
     * A map between units and a comma-separated list of measurement systems to which
     * they belong.
     */
    'unit-to-systems' => [
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
    'conversions' => [
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
