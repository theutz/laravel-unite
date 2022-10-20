<?php

namespace Theutz\Unite;

use Illuminate\Config\Repository;

class Reference
{
    const CONFIG_PREFIX = 'unite.';

    public function config(array|string|null $key = null, mixed $default = null): mixed
    {
        if (is_string($key)) {
            $key = self::CONFIG_PREFIX . $key;
        }

        if (is_array($key)) {
            $key = array_map(fn ($k) => self::CONFIG_PREFIX . $k, $key);
        }

        return config($key, $default);
    }
}
