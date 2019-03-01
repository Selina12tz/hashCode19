import domain.Photo;
import domain.Slide;
import domain.Slideshow;

import java.util.List;

public class Main {


    public static void main(String[] args){

//        String filename = "e_shiny_selfies";
        String filename = "b_lovely_landscapes";
//        String filename = "c_memorable_moments";
//        String filename = "d_pet_pictures";
//        String filename = "e_shiny_selfies";

        InputReader inputReader = new InputReader(filename);
        List<Photo> photos = inputReader.readFile();
        System.out.println(photos);

        //Solution solution = new MockSolution();
        Solution solution = new BruteSolution();

        Slideshow slideshow = solution.solve(photos);

        System.out.println(slideshow.toFile());

        OutputWriter outputWriter = new OutputWriter(filename);
        outputWriter.writeFile(slideshow);

    }
}
