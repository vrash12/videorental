
<?php


require_once 'config/utils.php';
require_once 'config/database.php';
require_once 'models/Rental.php';
require_once 'models/Video.php';
require_once 'helpers/email.php'; 
require_once 'models/User.php';
require_once 'models/Payment.php';




class AdminController
{
    private $db;
    private $videoModel;
    private $userModel;
    private $rentalModel;

    public function __construct()
    {
        checkRole('admin'); 
        $database = new Database();
        $this->db = $database->getConnection();
        $this->videoModel = new Video($this->db);
        $this->userModel = new User($this->db);
        $this->rentalModel = new Rental($this->db);

    }

    public function dashboard()
    {
        loadView('admin/dashboard');
    }
    public function manageReports()
    {
        $rentalStats = $this->rentalModel->getRentalStats();
        $financialStats = $this->rentalModel->getFinancialStats();
        $userActivityReports = $this->userModel->getUserActivityReports();
        $users = $this->userModel->readAll(); // Get all users
        loadView('admin/manageReports', [
            'rentalStats' => $rentalStats,
            'financialStats' => $financialStats,
            'userActivityReports' => $userActivityReports,
            'users' => $users
        ]);
    }
    

    public function manageVideos()
    {
        $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
        $video = null;
        if ($mode === 'edit' || $mode === 'delete') {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $video = $id ? $this->videoModel->readOne($id) : null;
        }

        $videos = $this->videoModel->readAll();
        loadView('admin/manageVideos', [
            'mode' => $mode,
            'videos' => $videos,
            'video' => $video
        ]);
    }

    public function addVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->videoModel->title = $_POST['title'];
            $this->videoModel->genre = $_POST['genre'];
            $this->videoModel->release_year = $_POST['release_year'];
            $this->videoModel->format = $_POST['format'];
            $this->videoModel->copies = $_POST['copies'];
            $this->videoModel->price = $_POST['price'];
            

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $this->videoModel->image = $uploadFile;
                } else {
                    $this->videoModel->image = null;
                }
            } else {
                $this->videoModel->image = null;
            }

            if ($this->videoModel->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageVideos');
                exit;
            } else {
                echo "Unable to create video.";
            }
        }
    }

    public function editVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->videoModel->id = $_POST['id'];
            $this->videoModel->title = $_POST['title'];
            $this->videoModel->genre = $_POST['genre'];
            $this->videoModel->release_year = $_POST['release_year'];
            $this->videoModel->format = $_POST['format'];
            $this->videoModel->copies = $_POST['copies'];
            $this->videoModel->price = $_POST['price'];
            
  
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $this->videoModel->image = $uploadFile;
                } else {
                    $this->videoModel->image = null;
                }
            } else {
                $this->videoModel->image = $_POST['existing_image']; 
            }

            if ($this->videoModel->update()) {
                header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageVideos');
                exit;
            } else {
                echo "Unable to update video.";
            }
        }
    }

    public function deleteVideo()
    {
        $video_id = $_POST['id'];
        
        // First delete the associated rentals
        $rentals = $this->rentalModel->readByVideo($video_id);
        foreach ($rentals as $rental) {
            $this->rentalModel->id = $rental['id'];
            $this->rentalModel->delete();
        }
    
        // Then delete the video
        $this->videoModel->id = $video_id;
    
        if ($this->videoModel->delete()) {
            header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageVideos');
            exit;
        } else {
            echo "Unable to delete video.";
        }
    }
    

    public function manageUsers()
    {
        $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
        $user = null;
        if ($mode === 'edit' || $mode === 'delete') {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $user = $id ? $this->userModel->readOne($id) : null;
        }

        $users = $this->userModel->readAll();
        loadView('admin/manageUsers', [
            'mode' => $mode,
            'users' => $users,
            'user' => $user
        ]);
    }

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->name = $_POST['name'];
            $this->userModel->email = $_POST['email'];
            $this->userModel->password = $_POST['password'];
            $this->userModel->role = $_POST['role'];
            $this->userModel->address = $_POST['address'];
            $this->userModel->phone = $_POST['phone'];

            if ($this->userModel->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageUsers');
                exit;
            } else {
                echo "Unable to create user.";
            }
        }
    }

    public function editUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->id = $_POST['id'];
            $this->userModel->name = $_POST['name'];
            $this->userModel->email = $_POST['email'];
            $this->userModel->role = $_POST['role'];
            $this->userModel->address = $_POST['address'];
            $this->userModel->phone = $_POST['phone'];

            if ($this->userModel->update()) {
                header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageUsers');
                exit;
            } else {
                echo "Unable to update user.";
            }
        }
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->id = $_POST['id'];
            if ($this->userModel->delete()) {
                header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageUsers');
                exit;
            } else {
                echo "Unable to delete user.";
            }
        }
    }

    public function sendReturnReminderToUser()
    {
        $userId = $_POST['user_id'];
        $user = $this->userModel->readOne($userId);
        $dueSoonRentals = $this->rentalModel->getDueSoonRentalsByUser($userId);
    
        foreach ($dueSoonRentals as $rental) {
            $subject = 'Return Reminder';
            $message = 'Hello ' . $user['name'] . ",\n\nThis is a reminder to return the video '" . $rental['title'] . "' by " . $rental['due_date'] . ".";
            sendEmail($user['email'], $subject, $message);
        }
    
        header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageReports');
        exit;
    }
    
    public function sendLateFeeAlertToUser()
    {
        $userId = $_POST['user_id'];
        $user = $this->userModel->readOne($userId);
        $lateRentals = $this->rentalModel->getLateRentalsByUser($userId);
    
        foreach ($lateRentals as $rental) {
            $subject = 'Late Fee Alert';
            $message = 'Hello ' . $user['name'] . ",\n\nThe video '" . $rental['title'] . "' was due on " . $rental['due_date'] . ". A late fee has been applied.";
            sendEmail($user['email'], $subject, $message);
        }
    
        header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageReports');
        exit;
    }


    // controllers/AdminController.php

public function profile()
{
    $user_id = $_SESSION['user_id'];
    $user = $this->userModel->readOne($user_id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user['name'] = $_POST['name'];
        $user['email'] = $_POST['email'];
        $user['address'] = $_POST['address'];
        $user['phone'] = $_POST['phone'];
        if (!empty($_POST['password'])) {
            $user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $this->userModel->id = $user_id;
        $this->userModel->name = $user['name'];
        $this->userModel->email = $user['email'];
        $this->userModel->address = $user['address'];
        $this->userModel->phone = $user['phone'];
        if (!empty($user['password'])) {
            $this->userModel->password = $user['password'];
        }

        if ($this->userModel->update()) {
            header('Location: ' . BASE_URL . '/index.php?controller=admin&action=profile');
            exit;
        } else {
            echo "Unable to update profile.";
        }
    }

    loadView('admin/profile', ['user' => $user]);
}

    
}

?>
