<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SystemsValidator
{
    private array $rules;

    private array $systems;

    public function __construct()
    {
        $this->systems = config('unite.systems');
        $this->rules = [
            'required',
            '*' => 'string',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $validator = Validator::make($this->systems, $this->rules);
        $validator->validate();
    }
}
