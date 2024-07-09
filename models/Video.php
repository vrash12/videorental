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

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (title, genre, release_year, format, copies, price_dvd, price_bluray, price_digital, image) 
                  VALUES (:title, :genre, :release_year, :format, :copies, :price_dvd, :price_bluray, :price_digital, :image)";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->format = htmlspecialchars(strip_tags($this->format));
        $this->copies = htmlspecialchars(strip_tags($this->copies));
        $this->price_dvd = htmlspecialchars(strip_tags($this->price_dvd));
        $this->price_bluray = htmlspecialchars(strip_tags($this->price_bluray));
        $this->price_digital = htmlspecialchars(strip_tags($this->price_digital));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":format", $this->format);
        $stmt->bindParam(":copies", $this->copies);
        $stmt->bindParam(":price_dvd", $this->price_dvd);
        $stmt->bindParam(":price_bluray", $this->price_bluray);
        $stmt->bindParam(":price_digital", $this->price_digital);
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

    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
        return $result;
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

    public function updateCopies($id, $copies)
    {
        $query = "UPDATE " . $this->table_name . " SET copies = :copies WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':copies', $copies);
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }
    

    // Get inventory statistics
    public function getInventoryStats()
    {
        $query = "SELECT genre, COUNT(*) as video_count, SUM(copies) as total_copies 
                  FROM " . $this->table_name . "
                  GROUP BY genre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchVideos($searchTerm, $genre, $releaseYear)
{
    $query = "SELECT * FROM " . $this->table_name . " WHERE 1=1";

    if (!empty($searchTerm)) {
        $query .= " AND title LIKE :searchTerm";
    }
    if (!empty($genre)) {
        $query .= " AND genre = :genre";
    }
    if (!empty($releaseYear)) {
        $query .= " AND release_year = :releaseYear";
    }

    $stmt = $this->conn->prepare($query);

    if (!empty($searchTerm)) {
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':searchTerm', $searchTerm);
    }
    if (!empty($genre)) {
        $stmt->bindParam(':genre', $genre);
    }
    if (!empty($releaseYear)) {
        $stmt->bindParam(':releaseYear', $releaseYear);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function getUserActivityReports()
{
    $query = "
        SELECT u.name, u.email, COUNT(r.id) as total_rentals, MAX(r.rental_date) as last_rental_date
        FROM " . $this->table_name . " u
        LEFT JOIN rentals r ON u.id = r.user_id
        GROUP BY u.id, u.name, u.email
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




}
?>
