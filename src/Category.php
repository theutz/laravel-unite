<?php

namespace Theutz\Unite;

enum Category: string
{
    case Unit = 'unit';

    public function validationRules()
    {
        return match ($this) {
            self::Unit => ['id' => 'required|string']
        };
    }
}
