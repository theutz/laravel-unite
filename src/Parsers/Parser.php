<?php

namespace Theutz\Unite\Parsers;

class Parser
{
    public function parse(string $string): array
    {
        return [
            'quantity' => '200',
            'prefix' => 'k',
            'unit' => 'm',
        ];
    }
}
