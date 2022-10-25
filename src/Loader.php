<?php

namespace Theutz\Unite;

use Symfony\Component\Yaml\Yaml;

class Loader
{
    public function __construct(
        private Yaml $yaml,
        private string $unitsPath,
    ) {
    }

    public function units(): array
    {
        return $this->yaml->parseFile($this->unitsPath);
    }
}
