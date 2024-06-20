<?php
class Rental
{
    private $conn;
    private $table_name = "rentals";

    public $id;
    public $user_id;
    public $video_id;
    public $rental_date;
    public $due_date;
    public $fee;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create new rental
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (user_id, video_id, rental_date, due_date, fee) VALUES (:user_id, :video_id, :rental_date, :due_date, :fee)";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->video_id = htmlspecialchars(strip_tags($this->video_id));
        $this->rental_date = htmlspecialchars(strip_tags($this->rental_date));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->fee = htmlspecialchars(strip_tags($this->fee));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":video_id", $this->video_id);
        $stmt->bindParam(":rental_date", $this->rental_date);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":fee", $this->fee);

        return $stmt->execute();
    }

    // Read all rentals by user
    public function readByUser($user_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one rental
    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update rental
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET user_id = :user_id, video_id = :video_id, rental_date = :rental_date, due_date = :due_date, fee = :fee WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->video_id = htmlspecialchars(strip_tags($this->video_id));
        $this->rental_date = htmlspecialchars(strip_tags($this->rental_date));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->fee = htmlspecialchars(strip_tags($this->fee));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":video_id", $this->video_id);
        $stmt->bindParam(":rental_date", $this->rental_date);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":fee", $this->fee);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Delete rental
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>
