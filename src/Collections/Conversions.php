<?php

namespace Theutz\Unite\Collections;

use Illuminate\Support\Collection;

class Conversions extends AbstractCollection
{
    public function __construct(
        array $conversions,
    ) {
        $this->collection = collect($conversions);
    }
}
