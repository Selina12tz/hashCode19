<?php
declare(strict_types=1);

namespace App;

class Row
{
    /**
     * @var Slice[]
     */
    private $slices = [];

    public function addSlice(Slice $slice): void
    {
        $this->slices[] = $slice;
    }
    public function getScore(): int
    {
        return array_reduce($this->slices, function ($sum, $slice) {
            return $sum += $slice->getScore();
        }, 0);
    }
    public function getSlices(): array
    {
        return $this->slices;
    }
}
