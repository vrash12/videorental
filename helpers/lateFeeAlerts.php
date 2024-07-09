<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/email.php';
require_once __DIR__ . '/../models/Rental.php';
require_once __DIR__ . '/../models/User.php';

$database = new Database();
$db = $database->getConnection();

$rentalModel = new Rental($db);
$userModel = new User($db);

$lateRentals = $rentalModel->getLateRentals(); 
foreach ($lateRentals as $rental) {
    $user = $userModel->readOne($rental['user_id']);
    $subject = 'Late Fee Alert';
    $message = 'Hello ' . $user['name'] . ",\n\nThe video '" . $rental['title'] . "' was due on " . $rental['due_date'] . ". A late fee has been applied.";
    sendEmail($user['email'], $subject, $message);
}
?>
