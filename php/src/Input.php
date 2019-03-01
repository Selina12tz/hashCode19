<?php

declare(strict_types=1);

namespace App;

class Input
{
    private $fileHandle;

    public function __construct(string $filename)
    {
        $this->fileHandle = fopen($filename, 'r');
        if ($this->fileHandle === false) {
            throw new \Exception('Cannot open input file');
        }
    }

    public function parsePhotos(): array
    {
        $isFirstLine = true;
        $photos = [];
        $id = 0;
        while ($line = fgets($this->fileHandle)) {
            if ($isFirstLine) {
                $isFirstLine = false;
            } else {
                list($orientation, $tagNumber, $tags) = explode(' ', trim($line), 3);
                $photos[] = new Photo($id, $orientation, $tags);
                $id++;
            }
        }
        return $photos;
    }
}
