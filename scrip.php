<?php
require_once 'config/database.php';

// Database connection
$database = new Database();
$db = $database->getConnection();

try {
    // Prepare the SQL statement
    $stmt = $db->prepare('INSERT INTO users (name, email, password, role, address, phone) VALUES (:name, :email, :password, :role, :address, :phone)');
    
    // Define the admin details
    $name = 'Admin User';
    $email = 'admin1@example.com';
    $password = password_hash('123', PASSWORD_DEFAULT); // Replace 'admin_password' with your preferred password
    $role = 'admin';
    $address = '123 Admin St';
    $phone = '555-0000';
    
    // Bind the parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Admin account created successfully.";
    } else {
        echo "Failed to create admin account.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
