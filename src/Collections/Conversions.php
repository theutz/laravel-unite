<?php

namespace Theutz\Unite\Collections;

use Illuminate\Support\Collection;

class Conversions
{
    private Collection $collection;

    public function __construct(
        array $conversions,
    ) {
        $this->collection = collect($conversions);
    }
}
