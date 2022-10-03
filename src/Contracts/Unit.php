<?php

namespace Theutz\Unite\Contracts;

use Theutz\Unite\Enums\BaseUnit;
use Theutz\Unite\Enums\Category;
use Theutz\Unite\Enums\Prefix;
use Theutz\Unite\Enums\System;

interface Unit
{
    public function baseUnit(): BaseUnit;

    public function system(): System;

    public function category(): Category;

    public function prefix(): ?Prefix;
}
