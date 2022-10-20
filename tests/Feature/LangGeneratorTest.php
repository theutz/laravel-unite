<?php

namespace Theutz\Unite;

it('can be instantiated', function () {
    expect(app(LangExporter::class))->toBeObject();
});
