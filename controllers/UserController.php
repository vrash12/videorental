<?php
// controllers/UserController.php

class UserController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate inputs
            if (empty($email) || empty($password)) {
                die('Please fill in all fields.');
            }

            // Check if user exists
            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role']; // Store the user role in the session
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                die('Invalid email or password.');
            }
        } else {
            loadView('user/login');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role = 'user'; // Default role

            // Validate inputs
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                die('Please fill in all fields.');
            }

            if ($password !== $confirmPassword) {
                die('Passwords do not match.');
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                die('Email already exists.');
            }

            // Insert user into database
            $stmt = $this->db->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword, 'role' => $role]);

            // Successful registration
            header('Location: ' . BASE_URL . '/index.php?controller=user&action=login');
            exit;
        } else {
            loadView('user/register');
        }
    }

    public function logout()
    {
        // Destroy session
        session_destroy();
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    public function profile()
    {
        checkRole('user'); // Ensure only regular users can access this method
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        loadView('user/profile', ['user' => $user]);
    }

    // Additional methods for profile management, rental history, etc.
}
?>
