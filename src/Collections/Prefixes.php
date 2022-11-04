<?php

namespace Theutz\Unite\Collections;

use Illuminate\Support\Collection;
use Theutz\Unite\Values\Prefix;

/**
 * @mixin Collection
 */
class Prefixes extends AbstractCollection
{
    public function __construct(
        private readonly array $prefixes
    ) {
        $this->collection = collect($prefixes)
            ->mapInto(Prefix::class);
    }
}
