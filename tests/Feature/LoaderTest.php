<?php

namespace Theutz\Unite;

use Illuminate\Validation\ValidationException;
use Mockery\MockInterface;
use Symfony\Component\Yaml\Yaml;

it('loads valid definitions', function ($category) {
    $sut = app(Loader::class);

    $result = $sut->load($category);

    expect($result)->toBeArray();
})->with('categories');

it('throws a validation exception', function ($category, $key, $value) {
    $this->mock(Yaml::class, function (MockInterface $mock) use ($key, $value) {
        $mock->allows([
            'parseFile' => [[$key => $value]],
        ]);
    });

    $sut = app(Loader::class);

    $result = $sut->load($category);
})->throws(ValidationException::class)
    ->with('categories')
    ->with([
        ['id', null],
        ['id', 123],
    ]);
