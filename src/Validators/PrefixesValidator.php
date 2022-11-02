<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Theutz\Unite\Exceptions\InvalidConfigException;

class PrefixesValidator
{
    public function __construct(
        private array $prefixes
    ) {
    }

    /**
     * @throws InvalidConfigException
     */
    public function validate(): void
    {
        try {
            $validator = Validator::make($this->prefixes, [
                'array',
            ]);
            $validator->validate();
        } catch (ValidationException) {
            throw new InvalidConfigException('unite.prefixes');
        }
    }
}
