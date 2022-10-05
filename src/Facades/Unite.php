<?php

namespace Theutz\Unite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Theutz\Unite\Unite make(mixed $quantity, mixed $unit)
 * @method static \Theutz\Unite\Unite parse(string $amount)
 *
 * @see \Theutz\Unite\Unite
 */
class Unite extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Theutz\Unite\Unite::class;
    }
}
