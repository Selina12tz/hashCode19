package domain;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.List;
import java.util.Objects;
import java.util.Set;

public class Slide {
    Photo photo;
    Photo photos[] = new Photo[2];
    Set<String> tags = new HashSet<>();
    String orientation;

    public Slide(Photo photo) {
        this.photo = photo;
        tags.addAll(photo.getTags());
        orientation = photo.getOrientation();
    }

    public Slide(Photo photo1, Photo photo2) {
        this.photos[0] = photo1;
        this.photos[1] = photo2;
        tags.addAll(photo1.getTags());
        tags.addAll(photo1.getTags());
        orientation = photo1.getOrientation();
    }

    public Set<String> getTags() {
        return tags;
    }

    @Override
    public String toString() {
        return "domain.Slide{" +
                "photo=" + photo +
                ", photos=" + Arrays.toString(photos) +
                ", tags=" + tags +
                ", orientation='" + orientation + '\'' +
                '}';
    }

    public String toFile() {
        if (orientation.equals("H")) {
            return String.valueOf(photo.getId());
        } else {
            return String.valueOf(photos[0].getId())
                    + " " +
                    String.valueOf(photos[1].getId());
        }
    }


    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        Slide slide = (Slide) o;
        return Objects.equals(photo, slide.photo) &&
                Arrays.equals(photos, slide.photos) &&
                Objects.equals(tags, slide.tags) &&
                Objects.equals(orientation, slide.orientation);
    }

    @Override
    public int hashCode() {
        int result = Objects.hash(photo, tags, orientation);
        result = 31 * result + Arrays.hashCode(photos);
        return result;
    }
}
