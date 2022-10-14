<?php

namespace Theutz\Unite\Data;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Yaml;
use Theutz\Unite\Category;

class Loader
{
    public function __construct(
        private Yaml $yml
    ) {
    }

    public function load(Category $category): array
    {
        $path = $this->makePath($category);
        $data = $this->yml->parseFile($path);

        $this->validate($data);

        return $data;
    }

    private function makePath(Category $category): string
    {
        return __DIR__.'/../../resources/unite/'.$category->value.'.yaml';
    }

    private function validate(array $data)
    {
        Validator::make($data, ['array', '*' => 'array'])->validate();
    }
}
