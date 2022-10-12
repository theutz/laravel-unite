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

it('throws a validation exception for units', function ($data, $message) {
    $this->mock(
        Yaml::class,
        fn (MockInterface $mock) => $mock
            ->allows(['parseFile' => $data])
    );

    $sut = app(Loader::class);

    expect(fn () => $sut->load(Category::Unit))
        ->toThrow(ValidationException::class, $message);
})
    ->with([
        'missing to' => [[
            ['id' => 'g', 'to' => null],
        ], 'must be an array'],
        'repeated ids' => [[
            ['id' => 'g', 'to' => []],
            ['id' => 'g', 'to' => []],
        ], 'has a duplicate value'],
    ]);
