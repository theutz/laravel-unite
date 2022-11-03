<?php

namespace Theutz\Unite\Validators;

use Illuminate\Contracts\Validation\Validator as LaravelValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RuntimeException;

/**
 * @mixin LaravelValidator
 */
abstract class AbstractValidator
{
    protected LaravelValidator $validator;

    public function __construct()
    {
        $this->validator = Validator::make(
            data: config("unite.{$this->configKey()}"),
            rules: $this->rules()
        );
    }

    public function __call(string $name, array $args): mixed
    {
        if (method_exists(LaravelValidator::class, $name)) {
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
                ->map(fn ($m) => "[laravel-unite]: {$this->errorPrefix()} | {$m}")
                ->all();
            throw ValidationException::withMessages($messages);
        }
    }

    abstract protected function errorPrefix(): string;

    abstract protected function configKey(): string;

    abstract protected function rules(): array;
}
