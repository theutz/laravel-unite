<?php

/**
 * Config for laravel-unite
 */
return [

    /**
     * The file path where the unit definitions are stored.
     */
    'units' => __DIR__.'/../resources/unite/units.yaml',

    /**
     * The file path where prefix definitions are stored.
     */
    'prefixes' => __DIR__.'/../resources/unite/prefixes.yaml',

    /**
     * The separation character used when defining plural terms. Defaults
     * to Laravel's default: the pipe `|` character.
     */
    'plural_separator' => '|',

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
