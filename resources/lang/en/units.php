<?php

$units = [
    'g' => ['gram', 'grams'],
    'm' => ['meter', 'meters'],
];

$prefixes = [
    'k' => 'kilo',
    'c' => 'centi',
];

$result = [];

foreach ($units as $unitAbbr => $unitNames) {
    $result[$unitAbbr] = implode('|', $unitNames);

    foreach ($unitNames as $unitName) {
        $result[$unitName] = $unitAbbr;
    }

    foreach ($prefixes as $prefixAbbr => $prefixName) {
        $key = "{$prefixAbbr}{$unitAbbr}";
        $names = array_map(fn ($unitName) => "{$prefixName}{$unitName}", $unitNames);

        $result[$key] = implode('|', $names);

        foreach ($names as $name) {
            $result[$name] = $key;
        }
    }
}

return $result;
