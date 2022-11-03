<?php

use Mockery\MockInterface;
use Theutz\Unite\Lang\Generator;

it('does not load the units more than once', function () {
    $this->mock(Generator::class, function (MockInterface $mock) {
        $mock->shouldReceive('symbolsToNames')
            ->once()
            ->andReturn(['g' => 'gram|grams']);
    });

    foreach (range(1, 10) as $count) {
        $trans = trans_choice('unite::units.g', 1);
        expect($trans)->toEqual('gram');
    }
});

it('does not load the symobls more than once', function () {
    $this->mock(Generator::class, function (MockInterface $mock) {
        $mock->shouldReceive('namesToSymbols')
            ->once()
            ->andReturn(['grams' => 'g']);
    });

    foreach (range(1, 10) as $count) {
        $trans = trans_choice('unite::symbols.grams', 1);
        expect($trans)->toEqual('g');
    }
});
