<?php

namespace Theutz\Unite;

use Symfony\Component\Yaml\Yaml;

class Loader
{
    public function __construct(
        private Yaml $yml
    ) {}

    public function load(Category $category): array
    {
        return $this->yml->parseFile(__DIR__."/../resources/unite/".$category->value.".yaml");
    }
}
