<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class KindsValidator
{
    private array $rules;

    private array $kinds;

    public function __construct()
    {
        $this->kinds = config('unite.kinds');
        $this->rules = ['required', 'string'];
    }

    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $validator = Validator::make($this->kinds, $this->rules);
        $validator->validate();
    }
}
