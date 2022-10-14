<?php

namespace Theutz\Unite\Data;

use Illuminate\Validation\ValidationException;
use Mockery\MockInterface;
use Symfony\Component\Yaml\Yaml;

it('loads valid definitions', function ($category) {
    $sut = app(Loader::class);

    $result = $sut->load($category);

    expect($result)->toBeArray();
})->with('models');

it('throws with invalid data', function ($category) {
    $this->mock(
        Yaml::class,
        fn (MockInterface $mock) => $mock
            ->allows(['parseFile' => [123]])
    );

    $sut = app(Loader::class);

    expect(fn () => $sut->load($category))
        ->toThrow(ValidationException::class);
})->with('models');
