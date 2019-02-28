<?php

declare(strict_types=1);

namespace App;

class Input
{
    // Rows
    private $R;

    // Columns
    private $C;

    // Minimum of each ingredient in slice
    private $L;

    // Maximum cells of slice
    private $H;

    /** @var string[] $pizza */
    private $pizza;

    public function __construct(string $filename)
    {
        $f = fopen($filename, 'r');
        if ($f !== false) {
            $this->parseInputFile($f);
        }
    }

    public function getR(): int
    {
        return $this->R;
    }

    public function getC(): int
    {
        return $this->C;
    }

    public function getL(): int
    {
        return $this->L;
    }

    public function getH(): int
    {
        return $this->H;
    }

    public function getPizza(): array
    {
        return $this->pizza;
    }

    private function parseInputFile($handle): void
    {
        $isFirstLine = true;
        $this->pizza = [];
        while ($line = fgets($handle)) {
            if ($isFirstLine) {
                list($this->R, $this->C, $this->L, $this->H) = array_map('intval', explode(' ', $line));
                $isFirstLine = false;
            } else {
                $this->pizza[] = trim($line);
            }
        }
    }
}
