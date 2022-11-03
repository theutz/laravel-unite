<?php

/**
 * Config for laravel-unite
 */
return [
    /**
     * Define the units that will be used throughout the system.
     */
    'units' => require __DIR__ . '/unite/units.php',

    /**
     * Define the metric prefixes to be used in the system.
     */
    'prefixes' => require __DIR__ . '/unite/prefixes.php',

    /**
     * Define the conversion rates/formulas between units
     */
    'conversions' => require __DIR__ . '/unite/conversions.php',

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
];
