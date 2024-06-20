<?php
// database.php

class Database {
    private $host = 'localhost'; // Database host
    private $db_name = 'video_rental'; // Database name
    private $username = 'root'; // Database username
    private $password = ''; // Database password
    private $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->conn;
    }
}

// Hash the password
$hashedPassword = password_hash('password123', PASSWORD_DEFAULT);

// Database connection
$database = new Database();
$db = $database->getConnection();

// Check if the admin user already exists
$stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => 'admin@example.com']);
$user = $stmt->fetch();

if ($user) {

} else {
    // Insert admin user
    $stmt = $db->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
    $stmt->execute([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => $hashedPassword,
        'role' => 'admin'
    ]);

    echo 'Admin user created successfully.';
}
?>
