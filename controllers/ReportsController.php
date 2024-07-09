<?php

require_once __DIR__ . '/../models/Video.php';
require_once __DIR__ . '/../models/Rental.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Payment.php';


class ReportsController
{
    private $db;
    private $videoModel;
    private $rentalModel;
    private $userModel;
    private $paymentModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->videoModel = new Video($this->db);
        $this->rentalModel = new Rental($this->db);
        $this->userModel = new User($this->db);
        $this->paymentModel = new Payment($this->db);
    }

    public function allReports()
    {
        $videos = $this->videoModel->readAll();
        $rentalStats = $this->rentalModel->getRentalStats();
        $userActivities = $this->userModel->getUserActivities();
        $financialStats = $this->rentalModel->getFinancialStats();

        loadView('reports/allReports', [
            'videos' => $videos,
            'rentalStats' => $rentalStats,
            'userActivities' => $userActivities,
            'financialStats' => $financialStats
        ]);
    }
}
?>
