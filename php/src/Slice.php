<?php

declare(strict_types=1);

namespace App;

class Slice
{
    private $r1;

    private $c1;

    private $r2;

    private $c2;
    
    /** @var string[] $contents */
    private $contents;

    public function __construct(int $r1, int $c1, int $r2, int $c2, Input $input)
    {
        $this->r1 = $r1;
        $this->c1 = $c1;
        $this->r2 = $r2;
        $this->c2 = $c2;

        $this->contents = $this->sliceContents($input->getPizza());
    }

    public function getContents(): array
    {
        return $this->contents;
    }

    public function getScore(): int
    {
        $height = (int)abs($this->r1 - $this->r2);
        $width = (int)abs($this->c1 - $this->c2);

        return $width * $height;
    }

    public function __toString(): string
    {
        $r2 = $this->r2 - 1;
        $c2 = $this->c2 - 1;
        return "{$this->r1} {$this->c1} $r2 $c2";
    }

    public function isValidContents(int $L): bool
    {
        $tCount = 0;
        $mCount = 0;
        foreach ($this->contents as $row) {
            $tCount += substr_count($row, 'T');
            $mCount += substr_count($row, 'M');
        }
        if ($mCount < $L || $tCount < $L) {
            return false;
        }

        return true;
    }
    public function isValidSize(int $H): bool
    {
        if ($this->getScore() > $H) {
            return false;
        }
        return true;
    }
    public function isValid(int $L, int $H): bool
    {
        return $this->isValidContents($L) && $this->isValidSize($H);
    }

    private function sliceContents(array $pizza): array
    {
        $contents = [];
        $r1 = $this->r1 < $this->r2 ? $this->r1 : $this->r2;
        $r2 = $this->r1 > $this->r2 ? $this->r1 : $this->r2;
        $c1 = $this->c1 < $this->c2 ? $this->c1 : $this->c2;
        $c2 = $this->c1 > $this->c2 ? $this->c1 : $this->c2;
        for ($i = $r1; $i < $r2; $i++) {
            $contents[] = substr($pizza[$i], $c1, $c2 - $c1);
        }

        return $contents;
    }
}
