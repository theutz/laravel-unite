<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PrefixesValidator
{
    private const RULES = [
        'required',
        '*.symbol' => 'required|string|distinct',
        '*.name' => 'required|string|distinct',
        '*.factor' => 'required|numeric|distinct',
    ];

    private array $prefixes;

    public function __construct()
    {
        $this->prefixes = config('unite.prefixes');
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $validator = Validator::make(
            $this->prefixes,
            self::RULES
        );

        $validator->validate();
    }
}
