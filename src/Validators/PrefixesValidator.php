<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

class PrefixesValidator extends AbstractValidator
{
    protected function rules(): array
    {
        return [

        'required',
        '*.symbol' => 'required|string|distinct',
        '*.name' => 'required|string|distinct',
        '*.factor' => 'required|numeric|distinct',
        ];
    }

    protected function configKey(): string
    {
        return 'prefixes';
    }

    protected function errorPrefix(): string
    {
        return 'Invalid Prefix Config';
    }
}
