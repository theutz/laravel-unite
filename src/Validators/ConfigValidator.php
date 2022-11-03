<?php

namespace Theutz\Unite\Validators;

use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class ConfigValidator
{
    private array $validatorClasses = [
        UnitsValidator::class,
        PrefixesValidator::class,
        KindsValidator::class,
        SystemsValidator::class,
    ];

    private Collection $validators;

    public function __construct()
    {
        $this->validators = collect($this->validatorClasses)
            ->map(fn ($className) => app($className));
    }

    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validators->each(fn ($v) => $v->validate());
    }
}
