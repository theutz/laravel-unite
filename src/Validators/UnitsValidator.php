<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UnitsValidator extends AbstractValidator
{
    protected function errorPrefix(): string
    {
        return 'Invalid Unit Config';
    }

    protected function configKey(): string
    {
        return 'units';
    }

    protected function rules(): array
    {
        return [
            'required',
            '*.symbol' => 'required',
            '*.name' => 'required',
            '*.aliases' => 'present',
            '*.aliases.*' => 'string',
            '*.kind' => ['required', Rule::in(config('unite.kinds'))],
            '*.systems' => 'required',
            '*.systems.*' => Rule::in(config('unite.systems')),
            '*.to' => 'present',
            '*.to.*.symbol' => [
                'required',
                'distinct',
                Rule::in(collect(config('unite.units'))->pluck('symbol')),
            ],
            '*.to.*.factor' => 'required|numeric',
        ];
    }
}
