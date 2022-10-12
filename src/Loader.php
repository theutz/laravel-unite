<?php

namespace Theutz\Unite;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Yaml;

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

        $this->validate($category, $data);

        return $data;
    }

    private function makePath(Category $category): string
    {
        return __DIR__.'/../resources/unite/'.$category->value.'.yaml';
    }

    private function validate(Category $category, array $data)
    {
        Validator::make($data, $category->validationRules())->validate();
    }
}
