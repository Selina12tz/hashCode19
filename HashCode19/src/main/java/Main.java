import domain.Photo;
import domain.Slide;
import domain.Slideshow;

import java.util.List;

public class Main {


    public static void main(String[] args){

        InputReader inputReader = new InputReader("a_example");
        List<Photo> photos = inputReader.readFile();
        System.out.println(photos);

        Solution solution = new MockSolution();

        Slideshow slideshow = solution.solve(photos);

        System.out.println(slideshow.toFile());

    }
}
