<?php

require_once 'models/User.php';
require_once 'models/Video.php';
require_once 'models/Rental.php';
require_once 'models/Payment.php';
require_once 'helpers/email.php'; // Include the email helper
class UserController
{
    private $db;
    private $userModel;
    private $videoModel;
    private $rentalModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
        $this->videoModel = new Video($this->db);
        $this->rentalModel = new Rental($this->db);
        $this->paymentModel = new Payment($this->db);
    }

    public function rentVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->rentalModel->user_id = $_SESSION['user_id'];
            $this->rentalModel->video_id = $_POST['video_id'];
            $this->rentalModel->rental_date = date('Y-m-d H:i:s');
            $this->rentalModel->due_date = date('Y-m-d H:i:s', strtotime('+' . $_POST['rental_days'] . ' days'));
    
            // Calculate the fee based on the rental period and format
            $format = $_POST['format'];
            $rentalDays = (int)$_POST['rental_days'];
            $feePerDay = $this->getFeePerDay($format);
            $this->rentalModel->fee = $rentalDays * $feePerDay;
    
            if ($this->rentalModel->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=user&action=dashboard');
                exit;
            } else {
                echo "Unable to rent video.";
            }
        } else {
            $video_id = $_GET['video_id'];
            $video = $this->videoModel->readOne($video_id);
            loadView('user/rentVideo', ['video' => $video]);
        }
    }
    
    private function getFeePerDay($format)
    {
        switch ($format) {
            case 'DVD':
                return 1.00;
            case 'Blu-ray':
                return 1.50;
            case 'Digital':
                return 2.00;
            default:
                return 1.00;
        }
    }
    
    
    
    public function updateProfile()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->userModel->id = $_SESSION['user_id'];
        $this->userModel->name = $_POST['name'];
        $this->userModel->email = $_POST['email'];
        $this->userModel->role = $_SESSION['user_role']; // Role should not be updated by user
        $this->userModel->address = $_POST['address'];
        $this->userModel->phone = $_POST['phone'];

        $newPassword = !empty($_POST['password']) ? $_POST['password'] : null;

        if ($this->userModel->update($newPassword)) {
            header('Location: ' . BASE_URL . '/index.php?controller=user&action=profile');
            exit;
        } else {
            echo "Unable to update profile.";
        }
    } else {
        $user = $this->userModel->readOne($_SESSION['user_id']);
        loadView('user/updateProfile', ['user' => $user]);
    }
}

    
    
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                die('Please fill in all fields.');
            }

            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role']; 

                if ($user['role'] == 'admin') {
                    header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageVideos');
                } else {
                    header('Location: ' . BASE_URL . '/index.php?controller=user&action=browseVideos');
                }
                exit;
            } else {
                die('Invalid email or password.');
            }
        } else {
            loadView('user/login');
        }
    }

    public function dashboard()
    {
        $user_id = $_SESSION['user_id'];
        $rentals = $this->rentalModel->readByUser($user_id);
        $payments = $this->paymentModel->readByUser($user_id); // Retrieve user payments
        loadView('user/dashboard', ['rentals' => $rentals, 'payments' => $payments]);
    }

    public function rentalHistory()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/index.php?controller=user&action=login');
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $rentals = $this->rentalModel->readRentalHistoryByUser($user_id);
    loadView('user/rentalHistory', ['rentals' => $rentals]);
}

    
    

    public function browseVideos()
    {
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $genre = isset($_GET['genre']) ? $_GET['genre'] : '';
        $releaseYear = isset($_GET['release_year']) ? $_GET['release_year'] : '';
    
        $videos = $this->videoModel->searchVideos($searchTerm, $genre, $releaseYear);
        loadView('user/browseVideos', ['videos' => $videos, 'searchTerm' => $searchTerm, 'genre' => $genre, 'releaseYear' => $releaseYear]);
    }
    

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role = 'user'; 
    
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                die('Please fill in all fields.');
            }
    
            if ($password !== $confirmPassword) {
                die('Passwords do not match.');
            }
    
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                die('Email already exists.');
            }
    
            $stmt = $this->db->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword, 'role' => $role]);
    
            // Send registration confirmation email
            $subject = 'Registration Confirmation';
            $message = 'Hello ' . $name . ",\n\nThank you for registering at our Video Rental System.";
            sendEmail($email, $subject, $message);
    
            header('Location: ' . BASE_URL . '/index.php?controller=user&action=login');
            exit;
        } else {
            loadView('user/register');
        }
    }
    
    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    public function profile()
    {
        checkRole('user');
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        loadView('user/profile', ['user' => $user]);
    }
}
?>
