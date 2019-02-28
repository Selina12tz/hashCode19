package domain;

import domain.Slide;

import java.util.ArrayList;
import java.util.List;

public class Slideshow {

    List<Slide> slides = new ArrayList<>();

    public void addSlide(Slide slide) {
        slides.add(slide);
    }

    public String toFile() {
        StringBuilder b = new StringBuilder();
        b.append(slides.size());
        b.append("\n");
        slides.forEach(slide -> {
            b.append(slide.toFile()).append("\n");
        });
        return b.toString();
    }
}
