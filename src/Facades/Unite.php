<?php

namespace Theutz\Unite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self make(mixed $amount, mixed $unit)
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
