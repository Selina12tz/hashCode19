package domain;

import java.util.HashSet;
import java.util.Set;

public class Photo {

    public Photo(int id, Set<String> tags) {
        this.id = id;
        this.tags = tags;
    }

    int id;
    Set<String> tags;
    String orientation;

    public Photo(int id, Set<String> tags, String orientation) {
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

    public Set<String> getTags() {
        return tags;
    }

    public void setTags(Set<String> tags) {
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
