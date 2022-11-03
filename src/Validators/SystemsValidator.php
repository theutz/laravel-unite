<?php

namespace Theutz\Unite\Validators;

class SystemsValidator extends AbstractValidator
{
    protected function rules(): array
    {
        return ['required', '*' => 'string'];
    }

    protected function configKey(): string
    {
        return 'systems';
    }

    protected function errorPrefix(): string
    {
        return 'Invalid Systems Config';
    }
}
