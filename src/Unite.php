<?php

namespace Theutz\Unite;

class Unite
{
    private string $from;

    public function convert(string $string): self
    {
        $this->from = $string;

        return $this;
    }

    public function to(string $string): string
    {
        return $this->from;
    }
}
