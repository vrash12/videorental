<?php
class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $address;
    public $phone;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, role, address, phone) VALUES (:name, :email, :password, :role, :address, :phone)";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);

        return $stmt->execute();
    }


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

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, role = :role, address = :address, phone = :phone";
        if (!empty($this->password)) {
            $query .= ", password = :password";
        }
        $query .= " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
    
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        if (!empty($this->password)) {
            $stmt->bindParam(":password", $this->password);
        }
        $stmt->bindParam(":id", $this->id);
    
        return $stmt->execute();
    }
    


    
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
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
