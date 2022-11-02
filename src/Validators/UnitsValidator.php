<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use RuntimeException;

/**
* @mixin ValidatorContract
*/
class UnitsValidator
{
    private array $rules;

    private array $units;

    private array $messages;

    private array $attributes;

    private ValidatorContract $validator;

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
        $this->messages = [];
        $this->attributes = [];

        $this->validator = Validator::make($this->units, $this->rules, $this->messages, $this->attributes);
    }

    public function __call(string $name, array $args): mixed
    {
        if (method_exists(ValidatorContract::class, $name)) {
            return $this->validator->$name(...$args);
        }

        throw new RuntimeException("{$name} method not found");
    }


    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $this->validator->validate();
    }
}
