<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UnitsValidator
{
    private array $rules;

    private array $units;

    public function __construct()
    {
        $this->units = config('unite.units');
        $this->rules = [
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
                Rule::in(collect($this->units)->pluck('symbol')),
            ],
            '*.to.*.factor' => 'required|numeric',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $validator = Validator::make($this->units, $this->rules);
        $validator->validate();
    }
}
