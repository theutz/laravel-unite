<?php

namespace Theutz\Unite\Intl;

use NumberFormatter;

class NumberFormatterBuilder
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
