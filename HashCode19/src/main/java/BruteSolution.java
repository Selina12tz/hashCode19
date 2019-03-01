import domain.Photo;
import domain.Slide;
import domain.Slideshow;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.stream.Collectors;

public class BruteSolution implements Solution{
    Slideshow slideshow = new Slideshow();

    @Override
    public Slideshow solve(List<Photo> photos) {

        Map<String, List<Slide>> dictionary = new HashMap<>();

        List<Slide> slides = new ArrayList<>() ;
                //createSlides(photos);

        List<Slide> hslides = createHSlides(photos);

        List<Slide> vslides = createVSlides(photos);

        slides.addAll(hslides);
        slides.addAll(vslides);

        slides.forEach(s -> {
            s.getTags().forEach(t -> {
                dictionary.computeIfAbsent(t, k -> {
                    return new ArrayList<Slide>();
                }).add(s);
            });
        });

        //       System.out.println(dictionary);

        List<Slide> first = null;
        String firsttag = "";

        for (Map.Entry<String, List<Slide>> entry : dictionary.entrySet()) {
            if (entry.getValue().size() > 1) {
                first = entry.getValue();
                firsttag = entry.getKey();
                break;
            }
        }

        slideshow.addSlide(first.get(0));
        removeSlide(dictionary, first.get(0));
        slideshow.addSlide(first.get(0));
        removeSlide(dictionary, first.get(0));
        Slide lastSlide = slideshow.getLastSlide();

        while (slides.size() != slideshow.getSlides().size()) {
            for (String t : dictionary.keySet()) {
                if (lastSlide !=null) {
                    while (true) {
                        firsttag = nextSlide(dictionary, firsttag, lastSlide);
                        lastSlide = slideshow.getLastSlide();
                        if (firsttag.equals("")) {
                            break;
                        }
                    }
                }
                firsttag = t;
                List<Slide> sli = dictionary.get(t);
                if (!sli.isEmpty()) {
                    lastSlide = sli.get(0);
                    slideshow.addSlide(lastSlide);
                    removeSlide(dictionary, lastSlide);

                } else {
                    lastSlide = null;
                }
            }
        }


        return slideshow;
    }

    String nextSlide(Map<String, List<Slide>> dictionary, String lasttag, Slide lastSlide) {

        for (String nexttag : lastSlide.getTags()) {
            if (!nexttag.equals(lasttag)) {
                if (dictionary.get(nexttag) != null) {
                    for (Slide nextSlide : dictionary.get(nexttag)) {
                        if (!nextSlide.equals(lastSlide)) {
                            slideshow.addSlide(nextSlide);
                            removeSlide(dictionary, nextSlide);
                            return nexttag;
                        }
                    }
                }
            }
        }
        return "";
    }

    void removeSlide(Map<String, List<Slide>> dictionary, Slide slide) {
        slide.getTags().forEach(t -> {
            List<Slide> list = dictionary.get(t);
            list.remove(slide);
            if (list.isEmpty()) {
                //dictionary.remove(t);
            }
        });
    }

    List<Slide> createSlides(List<Photo> photos) {
        List<Photo> vphoto = new ArrayList<>(1);

        List<Slide> slides = photos.stream().map(p -> {
            if (p.getOrientation().equals("H")) {
                return new Slide(p);
            } else if (vphoto.size() == 0) {
                vphoto.add(p);
                return null;
            } else {
                Slide s = new Slide(vphoto.get(0), p);
                vphoto.clear();
                return s;
            }
        }).filter(s -> s != null).collect(Collectors.toList());

        return slides;
    }

    List<Slide> createHSlides(List<Photo> photos) {
        List<Slide> slides = photos.stream().filter(p->p.getOrientation().equals("H"))
                .map(p -> new Slide(p)
        ).collect(Collectors.toList());

        return slides;
    }

    List<Slide> createVSlides(List<Photo> ph) {
        List<Photo> photos = ph.stream()
                .filter(p->p.getOrientation().equals("V"))
                .collect(Collectors.toList());

        Photo array[] = new Photo[photos.size()];
        array = photos.toArray(array);
        int requirements = 0;
        List<Slide> list = new ArrayList<>();
        boolean dontStop = true;
        while(dontStop) {
            dontStop = false;
            for (int i = 0; i < array.length; i++) {

                if (array[i] != null) {
                    dontStop = true;
                    for (int j = i + 1; j < array.length; j++) {
                        if (array[j] != null) {
                            Set<String> tags = new HashSet<>(array[i].getTags().size());
                            tags.addAll(array[i].getTags());
                            tags.retainAll(array[j].getTags());
                            if (tags.size() == requirements) {
                                list.add(new Slide(array[i], array[j]));
                                array[i] = null;
                                array[j] = null;
                                break;
                            }
                        }
                    }
                }
            }
            requirements++;
        }
        return list;

    }

}
