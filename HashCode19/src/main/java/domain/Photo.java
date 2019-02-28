package domain;

import java.util.List;

public class Photo {
    public Photo(int id, List<String> tags) {
        this.id = id;
        this.tags = tags;
    }

    int id;
    List<String> tags;
    String orientation;

    public Photo(int id, List<String> tags, String orientation) {
        this.id = id;
        this.tags = tags;
        this.orientation = orientation;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public List<String> getTags() {
        return tags;
    }

    public void setTags(List<String> tags) {
        this.tags = tags;
    }

    public String getOrientation() {

        return orientation;
    }

    public void setOrientation(String orientation) {
        this.orientation = orientation;
    }

    @Override
    public String toString() {
        return "domain.Photo{" +
                "id=" + id +
                ", tags=" + tags +
                ", orientation='" + orientation + '\'' +
                '}';
    }
}
