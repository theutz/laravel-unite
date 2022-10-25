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
     * The file path where the unit definitions are stored.
     */
    'units' => __DIR__ . '/../resources/unite/units.yaml',
];
