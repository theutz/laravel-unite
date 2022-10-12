<?php

namespace Theutz\Unite;

$categories = collect(Category::cases())
    ->mapWithKeys(fn ($item) => [$item->value => $item]);

it('loads the definitions', function ($category) {
    $sut = app(Loader::class);

    $result = $sut->load($category);

    expect($result)->toBeArray();
})->with($categories);

it('validates the definitions', function () {
    $sut = app(Loader::class);
});
