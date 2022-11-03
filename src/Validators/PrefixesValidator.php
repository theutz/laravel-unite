<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class PrefixesValidator
{
    private array $rules = [
        'required',
        '*.symbol' => 'required|string|distinct',
        '*.name' => 'required|string|distinct',
        '*.factor' => 'required|numeric|distinct',
    ];

    private array $prefixes;

    private ValidatorContract $validator;

    public function __construct()
    {
        $this->prefixes = config('unite.prefixes');
        $this->validator = Validator::make(
            data: $this->prefixes,
            rules: $this->rules
        );
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        try {
            $this->validator->validate();
        } catch (ValidationException) {
            $messages = collect($this->validator->errors()->all())
                ->map(fn ($m) => "[laravel-unite]: Invalid Prefix Config | {$m}")
                ->all();

            throw ValidationException::withMessages($messages);
        }
    }
}
