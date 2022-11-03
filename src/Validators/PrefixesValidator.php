<?php

namespace Theutz\Unite\Validators;

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
