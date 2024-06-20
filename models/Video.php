<?php
class Video
{
    private $conn;
    private $table_name = "videos";

    public $id;
    public $title;
    public $genre;
    public $release_year;
    public $format;
    public $copies;
    public $price;
    public $image;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create new video
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (title, genre, release_year, format, copies, price, image) VALUES (:title, :genre, :release_year, :format, :copies, :price, :image)";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->format = htmlspecialchars(strip_tags($this->format));
        $this->copies = htmlspecialchars(strip_tags($this->copies));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":format", $this->format);
        $stmt->bindParam(":copies", $this->copies);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);

        return $stmt->execute();
    }

    // Read all videos
    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one video
    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update video
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET title = :title, genre = :genre, release_year = :release_year, format = :format, copies = :copies, price = :price, image = :image WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->format = htmlspecialchars(strip_tags($this->format));
        $this->copies = htmlspecialchars(strip_tags($this->copies));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":format", $this->format);
        $stmt->bindParam(":copies", $this->copies);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Delete video
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>
