<?php

namespace Theutz\Unite;

enum Category: string
{
    case Unit = 'unit';
    case Prefix = 'prefix';

    public function validationRules()
    {
        return match ($this) {
            self::Unit => ['id' => 'required|string', 'to' => 'required|array'],
            self::Prefix => ['id' => 'required|string']
        };
    }
}
