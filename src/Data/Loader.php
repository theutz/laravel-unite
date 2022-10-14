<?php

namespace Theutz\Unite\Data;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Yaml;

class Loader
{
    public function __construct(
        private Yaml $yml
    ) {
    }

    public function load(Model $model): array
    {
        $path = $this->makePath($model);
        $data = $this->yml->parseFile($path);

        $this->validate($data);

        return $data;
    }

    private function makePath(Model $model): string
    {
        $filename = str($model::class)->classBasename()->lower();

        return __DIR__.'/../../resources/unite/'.$filename.'.yaml';
    }

    private function validate(array $data)
    {
        Validator::make($data, ['array', '*' => 'array'])->validate();
    }
}
