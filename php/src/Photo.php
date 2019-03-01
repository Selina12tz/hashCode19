<?php

declare(strict_types=1);

namespace App;

class Photo
{
    private $id;

    private $orientation;

    private $tags;

    public function __construct(int $id, string $orientation, string $tags)
    {
        $this->id = $id;
        $this->orientation = $orientation;
        $this->tags = explode(' ', $tags);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function __toString(): string
    {
        return (string)$this->id;
    }
}
