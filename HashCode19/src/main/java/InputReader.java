import domain.Photo;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class InputReader {

    private String fileName;

    public InputReader(String fileName) {
        this.fileName = "HashCode19/" + fileName + ".txt";
    }

    public List<Photo> readFile() {
        FileReader fr;
        BufferedReader br;

        String fileLine;
        String[] fileArray;

        List<Photo> photos = null;

        try {
            fr = new FileReader(fileName);
            br = new BufferedReader(fr);
            fileLine = br.readLine();
            int photosNum = Integer.parseInt(fileLine);

            photos = new ArrayList<>(photosNum);

            int id = 0;

            while ((fileLine = br.readLine()) != null) {
                fileArray = fileLine.split(" ");

                String orientation = fileArray[0];
                int numoftags = Integer.parseInt(fileArray[1]);

                List<String> tags = new ArrayList<>(numoftags);
                for(int i = 2; i < numoftags+2; i++) {
                    tags.add(fileArray[i]);
                    //System.out.println(outputArray[i]);
                }

                Photo photo = new Photo(id++, tags, orientation);

                photos.add(photo);
            }


        } catch (FileNotFoundException e) {
            System.out.println("File not found.");
        } catch (IOException e) {
            System.out.println("I/O Exception");
        }

        return photos;
    }

}
