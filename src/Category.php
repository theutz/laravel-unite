<?php

namespace Theutz\Unite;

enum Category: string
{
    case Unit = 'unit';
    case Prefix = 'prefix';

    public function validationRules()
    {
        return match ($this) {
            self::Unit => [
                'array:id,to',
                '*.id' => 'required|string|distinct',
                '*.to' => 'present|array',
            ],
            self::Prefix => [
                '*.id' => 'required|string',
            ]
        };
    }
}
