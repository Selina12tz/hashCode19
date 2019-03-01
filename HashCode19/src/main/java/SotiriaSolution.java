import domain.Photo;
import domain.Slideshow;

import java.util.List;

public class SotiriaSolution implements Solution{
    @Override
    public Slideshow solve(List<Photo> photos) {
        return null;
    }

    /*

    List<Photo> photos;
    Map<Pair<Photo, Photo>, Double> mapOfVerticalsWeighted= new HashMap<>();
    Map<Pair<Slide, Slide>, Double> mapOfVerticalsSlidesWeighted= new HashMap<>();


    public SotiriaSolution(List<Photo> photos){
        this.photos = photos;
    }


    public void findLessTagsinVertical(){

        List<Photo> verticalPhotos = photos.stream()
                .filter(photo -> photo.getOrientation().equals("V"))
                .collect(Collectors.toList());

        List<Photo> reversed = Lists.reverse(verticalPhotos);

        List<Pair<Photo, Photo>> listPairs = new ArrayList<>();

        verticalPhotos.forEach(
                verticalPhoto -> {
                    reversed.forEach(non -> {

                        if(verticalPhoto.getId() != non.getId()){
                            listPairs.add(Pair.of(verticalPhoto, non));
                        }
                    });
                    int i = 1;
                }
        );

      listPairs.stream().forEach(pair -> {

          MinHash minHash = new MinHash<String>(pair.getLeft().getTags().size() + pair.getRight().getTags().size());

          mapOfVerticalsWeighted.put(pair, minHash.similarity(pair.getLeft().getTags(), pair.getRight().getTags()));

          System.out.println(mapOfVerticalsWeighted.get(pair));

      });
    }

    @Override
    public Slideshow solve(List<Photo> photos) {

        Slideshow slideshow = new Slideshow();
        List<Photo> hor = photos.stream()
                .filter(photo -> photo.getOrientation().equals("H"))
                .collect(Collectors.toList());

        List<Slide> slides = new ArrayList<>();

//        hor.stream().forEach(hori -> slides.add(new Slide(hori)));

        mapOfVerticalsWeighted.keySet().stream().forEach(pair -> slides.add(new Slide(pair.getLeft(), pair.getRight())));

        List<Slide> reversedSlides = Lists.reverse(slides);

        List<Pair<Slide, Slide>> listSlides = new ArrayList<>();

        slides.forEach(
                slide -> {
                    reversedSlides.forEach(non -> {

                        if(slide.getPhotos() != non.getPhotos()){
                            listSlides.add(Pair.of(slide, non));
                        }
                    });
                    int i = 1;
                }
        );

        listSlides.stream().forEach(pair -> {

            MinHash minHash = new MinHash<String>(pair.getLeft().getTags().size() + pair.getRight().getTags().size());

            mapOfVerticalsSlidesWeighted.put(pair, minHash.similarity(pair.getLeft().getTags(), pair.getRight().getTags()));

            System.out.println(mapOfVerticalsSlidesWeighted.get(pair));

        });


//        mapOfVerticalsSlidesWeighted.entrySet().stream().max((entry1, entry2) -> entry1.getValue() > entry2.getValue() ?1 : -1).get().getKey();

        Pair<Slide, Slide> key = Collections.max(mapOfVerticalsSlidesWeighted.entrySet(), Comparator.comparingDouble(Map.Entry::getValue)).getKey();

        

        return slideshow;
    }

*/

}
