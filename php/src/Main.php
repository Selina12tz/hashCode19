<?php
declare(strict_types=1);

namespace App;

function _($a): void
{
    if (false) {
        if (is_array($a)) {
            foreach ($a as $b) {
                echo $b  . "\n";
            }
        } else {
            echo $a  . "\n";
        }
    }
}
class Main
{
    public function __invoke(string $filename)
    {
        $input = new Input($filename);
        $photos = $input->parsePhotos();
        $output = new Output();

        //stage 1: form slides
        //TODO score
        $allSlides = [];
        $slideId = 0;
        $verticals = [];
        foreach ($photos as $photo) {
            if ($photo->getOrientation() == 'H') {
                $slide = new Slide($slideId);
                $slide->addPhoto($photo);
                $allSlides[$slideId] = $slide;
                $slideId++;
            } else {
                $verticals[] = $photo;
            }
        }
        $verticalSlides = $this->populateVerticals($verticals, $slideId);
        // keep keys
        $allSlides = $allSlides + $verticalSlides;

        //stage 2: create tag dictionary
        $tags = [];
        foreach ($allSlides as $slide) {
            foreach ($slide->getTags() as $tag) {
                if (!isset($tags[$tag])) {
                    $tags[$tag] = [];
                }
                $tags[$tag][] = $slide->getId();
            }
        }

        //stage 3: create output based on tags
        //TODO score, second run, in case more than 2
        foreach ($tags as $tag => $slideIds) {
            // TODO score Get ANY tag
            if (count($tags[$tag]) >= 2) {
                _("Using Tag $tag");
                //TODO score pick slideIds
                $slide1 = $allSlides[$tags[$tag][0]];
                $slide2 = $allSlides[$tags[$tag][1]];
                $output->addSlide($slide1);
                _("Adding slide " . $slide1->getId());
                $tags = $this->removeSlide($slide1->getId(), $tags);

                $output->addSlide($slide2);
                _("Adding slide " . $slide2->getId());
                $tags = $this->removeSlide($slide2->getId(), $tags);

                $nextTags = $slide2->getTags();
                $nextTags = array_filter($nextTags, function ($next) use ($tag) {
                    return $next !== $tag;
                });
                $nextTags = array_values($nextTags);
                // TODO score Next Tag Stage
                if (!empty($nextTags)) {
                    $nextTag = $nextTags[0];
                } else {
                    $nextTag = nul;
                }

                while ($nextTag) {
                    $slideIds = $tags[$nextTag];
                    if (count($slideIds) >= 1) {
                        $slideNext = $allSlides[$slideIds[0]];
                        $output->addSlide($slideNext);
                        _("Adding slide " . $slideNext->getId());
                        $tags = $this->removeSlide($slideNext->getId(), $tags);

                        $nextTags = $slideNext->getTags();
                        $nextTags = array_filter($nextTags, function ($next) use ($nextTag) {
                            return $next !== $nextTag;
                        });
                        $nextTags = array_values($nextTags);
                        if (!empty($nextTags)) {
                            $nextTag = $nextTags[0];
                        } else {
                            $nextTag = null;
                        }
                    } else {
                        $nextTag = null;
                    }
                }
            }
        }
        echo $output;
    }

    private function populateVerticals(array $verticals, int $slideId): array
    {
        $halfSlide = null;
        $slides = [];
        foreach ($verticals as $photo) {
            if ($halfSlide === null) {
                $halfSlide = new Slide($slideId);
                $halfSlide->addPhoto($photo);
            } else {
                $halfSlide->addPhoto($photo);
                $slides[$slideId] = $halfSlide;
                $halfSlide = null;
                $slideId++;
            }
        }
        return $slides;
    }

    private function removeSlide(int $id, array $tags): array
    {
        foreach ($tags as $tag => $ids) {
            $pos = array_search($id, $ids);
            if ($pos !== false) {
                _("Removing $id from $tag");
                //print_r($tags);
                unset($tags[$tag][$pos]);
                //print_r($tags);
                if (!empty($tags[$tag])) {
                    $tags[$tag] = array_values($tags[$tag]);
                }
            }
        }
        return $tags;
    }
}
