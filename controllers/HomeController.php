<?php
// controllers/HomeController.php

require_once 'models/Video.php';

class HomeController
{
    private $db;
    private $videoModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->videoModel = new Video($this->db);
    }

    public function index()
    {
        $videos = $this->videoModel->readAll();
        loadView('home', ['videos' => $videos]);
    }
}
?>
