<?php

declare(strict_types=1);

namespace App;

class Output
{
    /** @var Slide[] $slides */
    private $slides = [];

    public function addSlide(Slide $slide): void
    {
        $this->slides[] = $slide;
    }

    public function __toString(): string
    {
        $string = count($this->slides) . "\n";
        foreach ($this->slides as $slide) {
            $string .= $slide . "\n";
        }
        return $string;
    }
}
