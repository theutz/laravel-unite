<?php

namespace Theutz\Unite\Intl;

use NumberFormatter;

class NumberParser
{
    public function __construct(
        private string $locale
    ) {
    }

    private int $style = NumberFormatter::DEFAULT_STYLE;

    private ?string $pattern = null;

    public function build(): NumberFormatter
    {
        return new NumberFormatter(
            $this->locale,
            $this->style,
            $this->pattern
        );
    }

    public function parse(string $str): float|int|bool
    {
        return $this->build()->parse($str);
    }

    public function locale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function style(int $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function pattern(string $pattern): self
    {
        $this->pattern = $pattern;

        return $this;
    }
}
