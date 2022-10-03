<?php

namespace Theutz\Unite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Theutz\Unite\Unite
 */
class Unite extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Theutz\Unite\Unite::class;
    }
}
