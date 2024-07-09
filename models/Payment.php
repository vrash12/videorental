<?php
class Payment
{
    private $conn;
    private $table_name = "payments";

    public $id;
    public $user_id;
    public $rental_id; // This will store rental IDs as a comma-separated string for bulk payment
    public $amount;
    public $payment_method;
    public $payment_date;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create new payment
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (user_id, rental_id, amount, payment_method, payment_date) 
                  VALUES (:user_id, :rental_id, :amount, :payment_method, :payment_date)";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->rental_id = htmlspecialchars(strip_tags($this->rental_id));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->payment_method = htmlspecialchars(strip_tags($this->payment_method));
        $this->payment_date = htmlspecialchars(strip_tags($this->payment_date));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":rental_id", $this->rental_id);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":payment_method", $this->payment_method);
        $stmt->bindParam(":payment_date", $this->payment_date);

        return $stmt->execute();
    }

    // Read payments by user
    public function readByUser($user_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one payment
    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
