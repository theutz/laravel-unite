<?php

namespace Theutz\Unite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Theutz\Unite\Contracts\Manager make(mixed $quantity, mixed $unit)
 * @method static \Theutz\Unite\Contracts\Manager parse(string $amount)
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
