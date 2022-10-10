<?php

namespace Theutz\Unite\Manager;

use Theutz\Unite\Formatter\FormatterInterface;
use Theutz\Unite\Value\ValueDto;

/**
 * @property-read string $quantity
 * @property-read string $unit
 * @property-read string $prefix
 * @property-read string $baseUnit
 */
class Manager implements ManagerInterface
{
    private ValueDto $value;

    public function __construct(private FormatterInterface $formatter)
    {
    }

    public function __set(string $name, $args)
    {
        if (in_array($name, get_class_methods($this))) {
            $this->$name($args);
        }
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

    private function value(ValueDto $value): void
    {
        if (isset($this->value)) {
            throw new ReadonlyValueException('Value can only be set once.');
        }

        $this->value = $value;
    }
}
