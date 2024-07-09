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
    public $returned;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (user_id, video_id, rental_date, due_date, fee, returned) VALUES (:user_id, :video_id, :rental_date, :due_date, :fee, :returned)";
        $stmt = $this->conn->prepare($query);
    
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->video_id = htmlspecialchars(strip_tags($this->video_id));
        $this->rental_date = htmlspecialchars(strip_tags($this->rental_date));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->fee = htmlspecialchars(strip_tags($this->fee));
        $this->returned = htmlspecialchars(strip_tags($this->returned));
    
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":video_id", $this->video_id);
        $stmt->bindParam(":rental_date", $this->rental_date);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":fee", $this->fee);
        $stmt->bindParam(":returned", $this->returned);
    
        return $stmt->execute();
    }
    
    // Read all rentals by user
    public function readByUser($user_id)
    {
        $query = "
            SELECT r.*, v.title 
            FROM " . $this->table_name . " r
            JOIN videos v ON r.video_id = v.id
            WHERE r.user_id = :user_id";
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

    public function getRentalStats()
    {
        $query = "SELECT v.title, COUNT(*) as rental_count 
                  FROM " . $this->table_name . " r
                  JOIN videos v ON r.video_id = v.id
                  GROUP BY r.video_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFinancialStats()
    {
        $query = "SELECT SUM(fee) as total_revenue, COUNT(*) as total_rentals FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    


    public function calculateLateFee($rentalDate, $dueDate, $fee)
{
    $currentDate = new DateTime();
    $dueDate = new DateTime($dueDate);
    if ($currentDate > $dueDate) {
        $interval = $currentDate->diff($dueDate);
        $daysLate = $interval->days;
        $lateFee = $daysLate * 0.5; // Assuming a late fee of $0.5 per day
        return $lateFee;
    }
    return 0;
}

public function readRentalHistoryByUser($user_id)
{
    $query = "
        SELECT r.*, v.title, p.amount, p.payment_date, p.method
        FROM " . $this->table_name . " r
        JOIN videos v ON r.video_id = v.id
        LEFT JOIN payments p ON r.id = p.rental_id
        WHERE r.user_id = :user_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function getOverdueRentals()
{
    $query = "SELECT r.*, u.email, u.name, v.title 
              FROM " . $this->table_name . " r
              JOIN users u ON r.user_id = u.id
              JOIN videos v ON r.video_id = v.id
              WHERE r.due_date < CURDATE() AND r.returned = 0";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function markAsReturned($id)
{
    $query = "UPDATE " . $this->table_name . " SET returned = 1 WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

public function getDueSoonRentalsByUser($userId)
{
    $query = "SELECT r.*, v.title 
              FROM " . $this->table_name . " r 
              JOIN videos v ON r.video_id = v.id 
              WHERE r.user_id = :user_id 
              AND r.due_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 DAY) 
              AND r.returned = 0";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getLateRentalsByUser($userId)
{
    $query = "SELECT r.*, v.title 
              FROM " . $this->table_name . " r 
              JOIN videos v ON r.video_id = v.id 
              WHERE r.user_id = :user_id 
              AND r.due_date < NOW() 
              AND r.returned = 0";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function readByVideo($video_id)
{
    $query = "SELECT * FROM " . $this->table_name . " WHERE video_id = :video_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":video_id", $video_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





    
}
?>
