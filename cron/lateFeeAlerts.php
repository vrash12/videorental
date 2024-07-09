<?php
require_once '../config/database.php';
require_once '../models/Rental.php';
require_once '../models/User.php';
require_once '../helpers/email.php';

$database = new Database();
$db = $database->getConnection();

$rentalModel = new Rental($db);
$userModel = new User($db);

$overdueRentals = $rentalModel->getOverdueRentals();
foreach ($overdueRentals as $rental) {
    $lateFee = $rentalModel->calculateLateFee($rental['rental_date'], $rental['due_date'], $rental['fee']);
    $subject = 'Late Fee Alert';
    $message = 'Hello ' . $rental['name'] . ",\n\nThis is an alert that your rental of " . $rental['title'] . " is overdue. Your late fee is $" . number_format($lateFee, 2) . ". Please return it as soon as possible to avoid further late fees.";
    sendEmail($rental['email'], $subject, $message);
}

$upcomingReturns = $rentalModel->getUpcomingReturns();
foreach ($upcomingReturns as $rental) {
    $subject = 'Return Reminder';
    $message = 'Hello ' . $rental['name'] . ",\n\nThis is a reminder that your rental of " . $rental['title'] . " is due soon. Please return it by the due date to avoid late fees.";
    sendEmail($rental['email'], $subject, $message);
}
?>
