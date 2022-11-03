<?php

namespace Theutz\Unite\Validators;

class KindsValidator extends AbstractValidator
{
    protected function configKey(): string
    {
        return 'kinds';
    }

    protected function errorPrefix(): string
    {
        return 'Invalid Kinds Config';
    }

    protected function rules(): array
    {
        return ['required', 'string'];
    }
}
