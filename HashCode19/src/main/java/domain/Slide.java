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
    HashSet<String> tags = new HashSet<>();
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
        tags.addAll(photo2.getTags());
        orientation = photo1.getOrientation();
    }

    public HashSet<String> getTags() {
        return tags;
    }

    public Photo getPhoto() {
        return photo;
    }

    public void setPhoto(Photo photo) {
        this.photo = photo;
    }

    public Photo[] getPhotos() {
        return photos;
    }

    public void setPhotos(Photo[] photos) {
        this.photos = photos;
    }

    public void setTags(HashSet<String> tags) {
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
        return photo.equals(slide.photo) &&
                Arrays.equals(photos, slide.photos) &&
                tags.equals(slide.tags) &&
                orientation.equals(slide.orientation);
    }

    @Override
    public int hashCode() {
        int result = Objects.hash(photo, tags, orientation);
        result = 31 * result + Arrays.hashCode(photos);
        return result;
    }
}
