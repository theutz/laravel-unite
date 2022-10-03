<?php

use Theutz\Unite\Facades\Unite;

test('creation', function () {
    expect(Unite::make(200, 'g'))->toEqual('200 g');
});
