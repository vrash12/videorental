<?php
function checkRole($requiredRole)
{
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $requiredRole) {
        die('Access denied.');
    }
}
?>
