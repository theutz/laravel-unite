<?php

namespace Theutz\Unite\Data;

use Composer\ClassMapGenerator\ClassMapGenerator;

class Finder
{
    const MODEL_PATH = __DIR__.'/../Models';

    private array $names;

    public function find(): array
    {
        return $this->getNames();
    }

    private function getNames(): array
    {
        if (! isset($this->names)) {
            $map = ClassMapGenerator::createMap(self::MODEL_PATH);

            foreach ($map as $name => $path) {
                $this->names[] = $name;
            }
        }

        return $this->names;
    }
}
