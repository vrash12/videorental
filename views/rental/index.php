<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Rentals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar file -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">Manage Rentals</h1>
                <a href="<?php echo BASE_URL; ?>/index.php?controller=rental&action=create" class="button">Add Rental</a>
                <?php if (!empty($rentals)): ?>
                    <table class="hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Video</th>
                                <th>Rental Date</th>
                                <th>Due Date</th>
                                <th>Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rentals as $rental): ?>
                                <tr>
                                    <td><?php echo $rental['user_id']; ?></td>
                                    <td><?php echo $rental['video_id']; ?></td>
                                    <td><?php echo $rental['rental_date']; ?></td>
                                    <td><?php echo $rental['due_date']; ?></td>
                                    <td><?php echo $rental['fee']; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>/index.php?controller=rental&action=edit&id=<?php echo $rental['id']; ?>" class="button">Edit</a>
                                        <a href="<?php echo BASE_URL; ?>/index.php?controller=rental&action=delete&id=<?php echo $rental['id']; ?>" class="button alert">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No rentals found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
