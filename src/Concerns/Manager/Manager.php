<?php

namespace Theutz\Unite\Concerns\Manager;

use Theutz\Unite\Concerns\Formatter\FormatterInterface;
use Theutz\Unite\DTOs\Value;

/**
 * @property-read string $quantity
 * @property-read string $unit
 * @property-read string $prefix
 * @property-read string $baseUnit
 */
class Manager implements ManagerInterface
{
    private Value $value;

    public function __construct(private FormatterInterface $formatter)
    {
    }

    public function __set(string $name, $args)
    {
        switch ($name) {
            case 'value':
                if (! isset($this->value)) {
                    $this->value = $args;
                }
                break;
        }
    }

    public function setValue(Value $value): void
    {
        if (isset($this->value)) {
            throw new \RuntimeException('Value can only be set once.');
        }

        $this->value = $value;
    }

    public function __get(string $name)
    {
        if (in_array($name, get_class_methods($this->formatter))) {
            return $this->formatter->$name($this->value);
        }
    }

    public function __toString(): string
    {
        return $this->formatter->value($this->value);
    }
}
