<?php

use Theutz\Unite\Parsers\Parser;

it('can be instantiated')
    ->expect(fn () => app(Parser::class))
    ->toBeInstanceOf(Parser::class);
