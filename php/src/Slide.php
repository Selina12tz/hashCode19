<?php

declare(strict_types=1);

namespace App;

class Slide
{
    private $id;
    /** @var Photos[] $photos */
    private $photos;

    private $tags;

    public function __construct(int $id, ...$photos)
    {
        if (count($photos) == 2 &&
            ($photos[0]->getOrientation() == 'H' || $photos[1]->getOrientation() == 'H') ) {
            throw new \Exception('Cannot instantiate slide');
        }
        if (count($photos) > 2) {
            throw new \Exception('Cannot instantiate slide');
        }

        $this->id = $id;
        $this->photos = $photos;
        $tags = [];
        foreach ($photos as $photo) {
            $tags = array_merge($tags, $photo->getTags());
        }
        $this->tags = array_unique($tags);
    }
    public function getId():int
    {
        return $this->id;
    }
    public function getTags(): array
    {
        return $this->tags;
    }
    public function addPhoto(Photo $photo):void
    {
        $this->photos[] = $photo;
        $tags = array_merge($this->tags, $photo->getTags());
        $this->tags = array_unique($tags);
    }
    public function __toString()
    {
        $output = '';
        foreach ($this->photos as $photo) {
            $output .= $photo->getId() . ' ';
        }
        return trim($output);
    }
}
