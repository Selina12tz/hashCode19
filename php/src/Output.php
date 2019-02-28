<?php

declare(strict_types=1);

namespace App;

class Output
{
    /** @var Slice[] $slices */
    private $slices = [];

    public function addSlice(Slice $slice): void
    {
        $this->slices[] = $slice;
    }

    public function addRow(Row $row): void
    {
        foreach ($row->getSlices() as $slice) {
            $this->slices[] = $slice;
        }
    }

    public function __toString(): string
    {
        $string = count($this->slices) . "\n";
        foreach ($this->slices as $slice) {
            $string .= $slice . "\n";
        }
        return $string;
    }
}
