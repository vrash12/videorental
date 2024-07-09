<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/email.php';
require_once __DIR__ . '/../models/Rental.php';
require_once __DIR__ . '/../models/User.php';

$database = new Database();
$db = $database->getConnection();

$rentalModel = new Rental($db);
$userModel = new User($db);

$dueSoonRentals = $rentalModel->getDueSoonRentals();

foreach ($dueSoonRentals as $rental) {
    $user = $userModel->readOne($rental['user_id']);
    $subject = 'Return Reminder';
    $message = 'Hello ' . $user['name'] . ",\n\nThis is a reminder to return the video '" . $rental['title'] . "' by " . $rental['due_date'] . ".";
    sendEmail($user['email'], $subject, $message);
}
?>
