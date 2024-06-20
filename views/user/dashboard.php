<!-- views/user/dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>User Dashboard</h1>
        <h2>Your Rentals</h2>
        <table class="stack">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Rental Date</th>
                    <th>Due Date</th>
                    <th>Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['fee']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=browseVideos" class="button">Browse Videos</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
