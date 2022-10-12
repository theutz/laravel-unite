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

it('throws exception on all categories', function ($category, $data) {
    $this->mock(
        Yaml::class,
        fn (MockInterface $mock) => $mock
            ->allows(['parseFile' => [$data]])
    );

    app(Loader::class)->load($category);
})->throws(ValidationException::class)
    ->with('categories')
    ->with([
        [['id', null]],
        [['id', 123]],
    ]);

it('throws a validation exception for units', function ($data) {
    $this->mock(
        Yaml::class,
        fn (MockInterface $mock) => $mock->allows([
            'parseFile' => [$data],
        ])
    );

    app(Loader::class)->load(Category::Unit);
})
    ->throws(ValidationException::class)
    ->with([
        [['id' => 'gram', 'to' => []]],
    ]);
