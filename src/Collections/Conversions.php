<?php

namespace Theutz\Unite\Collections;

class Conversions extends AbstractCollection
{
    public function __construct(
        array $conversions,
    ) {
        $this->collection = collect($conversions);
    }
}
