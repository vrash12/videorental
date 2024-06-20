<?php

require_once 'config/database.php';
require_once 'config/utils.php';
require_once 'models/Video.php';


class AdminController
{
    private $db;
    private $videoModel;
    private $userModel;

    public function __construct()
    {
        checkRole('admin'); // Ensure only admins can access this controller
        $database = new Database();
        $this->db = $database->getConnection();
        $this->videoModel = new Video($this->db);
        $this->userModel = new User($this->db);
    }

    public function dashboard()
    {
        loadView('admin/dashboard');
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
            
            // Handle image upload
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
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $this->videoModel->image = $uploadFile;
                } else {
                    $this->videoModel->image = null;
                }
            } else {
                $this->videoModel->image = $_POST['existing_image']; // Keep existing image if no new image is uploaded
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->videoModel->id = $_POST['id'];
            if ($this->videoModel->delete()) {
                header('Location: ' . BASE_URL . '/index.php?controller=admin&action=manageVideos');
                exit;
            } else {
                echo "Unable to delete video.";
            }
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
}
class UserController
{
    private $db;
    private $videoModel;
    private $rentalModel;

    public function __construct()
    {
        checkRole('user'); // Ensure only users can access this controller
        $database = new Database();
        $this->db = $database->getConnection();
        $this->videoModel = new Video($this->db);
        $this->rentalModel = new Rental($this->db);
    }

    public function browseVideos()
    {
        $videos = $this->videoModel->readAll();
        loadView('user/browseVideos', ['videos' => $videos]);
    }

    public function rentVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->rentalModel->user_id = $_SESSION['user_id'];
            $this->rentalModel->video_id = $_POST['video_id'];
            $this->rentalModel->rental_date = date('Y-m-d H:i:s');
            $this->rentalModel->due_date = date('Y-m-d H:i:s', strtotime('+7 days'));
            $this->rentalModel->fee = $_POST['fee'];

            if ($this->rentalModel->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=user&action=browseVideos');
                exit;
            } else {
                echo "Unable to rent video.";
            }
        }
    }
}

?>
