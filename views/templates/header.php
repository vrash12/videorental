<!-- views/layout/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Rental System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">Video Rental System</li>
                <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=dashboard">Admin Dashboard</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=profile">Profile</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=login">Login</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="grid-container">
