<?php
// controllers/VideoController.php

class VideoController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index()
    {
        $stmt = $this->db->query('SELECT * FROM videos');
        $videos = $stmt->fetchAll();
        
        loadView('video/index', ['videos' => $videos]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $release_year = $_POST['release_year'];
            $format = $_POST['format'];
            $copies = $_POST['copies'];

            // Insert video into database
            $stmt = $this->db->prepare('INSERT INTO videos (title, genre, release_year, format, copies) VALUES (:title, :genre, :release_year, :format, :copies)');
            $stmt->execute([
                'title' => $title,
                'genre' => $genre,
                'release_year' => $release_year,
                'format' => $format,
                'copies' => $copies
            ]);

            header('Location: ' . BASE_URL . '/index.php?controller=video&action=index');
            exit;
        } else {
            loadView('video/add');
        }
    }

    // Additional methods for updating and deleting videos
}
?>
