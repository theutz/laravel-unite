<?php

namespace Theutz\Unite\Validators;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class UnitsValidator
{
    private ValidatorContract $validator;

    public function __construct()
    {
        $this->validator = Validator::make(
            data: config('unite.units'),
            rules: [
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
            ]
        );
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
    public function validate()
    {
        try {
            $this->validator->validate();
        } catch (ValidationException) {
            $messages = collect($this->validator->errors()->all())
                ->map(fn ($m) => "[laravel-unite]: Invalid Unit Config | {$m}")
                ->all();
            throw ValidationException::withMessages($messages);
        }
    }
}
