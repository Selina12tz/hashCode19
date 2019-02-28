import domain.Photo;
import domain.Slide;
import domain.Slideshow;

import java.util.List;

public class MockSolution implements Solution{

    @Override
    public Slideshow solve(List<Photo> photos) {
        Slideshow slideshow = new Slideshow();
        slideshow.addSlide(new Slide(photos.get(0)));
        slideshow.addSlide(new Slide(photos.get(3)));
        slideshow.addSlide(new Slide(photos.get(1), photos.get(2)));
        return slideshow;
    }
}
