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
     * This is the canonical listing of units.
     *
     * The key represents the ID used thorughout the system to idenfity the unit.
     *
     * The value represents any long names and/or aliases that might be used to identify
     * the unit. These will be used to dynamically generate language files for the
     * `en` locale, and thus the (likely) fallback locale for your app.
     *
     * Values are specified with the same syntax that Laravel's localizations values use,
     * with one signficant exception: aliases can appear separated by two semicolons. In this
     * way, we can specify multiple representations for a single unit. An example
     * below:
     *
     *    Root name       Alias
     *    ____|____       __|__
     *  Sing.    Pl.    Sing. Pl.
     * ___|___ ___|___  __| __|__
     * |      |      |  |  |    |
     * 'ampere|amperes;;amp|amps'
     */
    'units' => [
        'A' => 'ampere|amperes;;amp|amps',
        'acre' => 'acre|acres',
        'bar' => 'bar|bars',
        'C' => 'Celsius;;degree Celsius|degrees Celsius',
        'cd' => 'candela|candelas',
        'ch' => 'chain|chains',
        'cu ft' => 'cubic feet|cubic feet;;° C;;°C',
        'cu in' => 'cubic inch|cubic inches',
        'cu mi' => 'cubic mile|cubic miles',
        'cu yd' => 'cubic yard|cubid yards',
        'd' => 'day|days',
        'dry pt' => 'dry pint|dry pints',
        'dry qt' => 'dry quart|dry quarts',
        'F' => 'Fahrenheit;;degree Fahrenheit|degrees Fahrenheit;;° F;;°F',
        'fl oz' => 'fluid ounce|fluid ounces',
        'ft' => 'foot|feet',
        'fur' => 'furlong|furlongs',
        'g' => 'gram|grams',
        'gal' => 'gallon|gallons',
        'gil' => 'gill|gills',
        'h' => 'hour|hours',
        'in' => 'inch|inches',
        'K' => 'Kelvin;;degree Kelvin|degrees Kelvin;;° K;;°K',
        'L' => 'liter|liters',
        'lb' => 'pound|pounds;;lbs',
        'lea' => 'league|leagues',
        'long ton' => 'long ton|long tons',
        'm' => 'meter|meters',
        'm2' => 'meter squared|meters squared;;square meter|square meters;;m²',
        'm3' => 'meter cubed|meters cubed;;cubic meter|cubic meters;;m³',
        'mi' => 'mile|miles',
        'min' => 'minute|minutes',
        'mmHg' => 'millimeter of mercury|millimeters of mercury',
        'N' => 'Newton|Newtons',
        'oz' => 'ounce|ounces',
        'pt' => 'pint|pints',
        'qt' => 'quart|quarts',
        'rad' => 'radian|radians',
        's' => 'second|seconds',
        'sq ft' => 'square foot|square feet',
        'sq in' => 'square inch|square inches',
        'sq mi' => 'square mile|square miles',
        'sq yd' => 'square yard|square yards',
        'st' => 'stere|steres',
        'tbsp' => 'tablespoon|tablespoons',
        'ton' => 'ton|tons',
        'tsp' => 'teaspoon|teaspoons',
        'V' => 'volt|volts',
        'W' => 'watt|watts',
        'yd' => 'yard|yards',
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
